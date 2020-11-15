/**
 * Componente para renderizar tablapara CRUD
 */
Vue.component("table-component", {
  template:
    /*html*/
    `
    <div>
    <div class="row justify-content-center">
      <form id="navbar-search-main" class="navbar-search form-inline mr-sm-3 navbar-search-dark">
        <fieldset class="form-group mb-0"><!---->
          <div tabindex="-1" role="group" class="bv-no-focus-ring">
            <div role="group" class="input-group input-group-alternative input-group-merge"><!---->
                <input type="text" placeholder="Buscar" class="form-control" v-model="searchText" v-on:keyup="search">
                <div class="input-group-append">
                  <span class="input-group-text">
                    <i class="fas fa-search"></i>
                  </span>
                </div><!---->
            </div><!----><!----><!---->
          </div>
        </fieldset>
      </form>
    </div>
      <div class="mt-4" style="color: red;"><strong>{{error}}</strong></div>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Dirección</th>
                    <th scope="col">Ciudad</th>
                    <th scope="col">País</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Campos para el registro de usuarios-->
                <tr disabled>
                    <td></td>
                    <td><input type="text" name="name" class="form-control" v-model="nombre" :disabled="isEditing"></td>
                    <td><input type="text" name="apellido" class="form-control" v-model="apellido" :disabled="isEditing"></td>
                    <td><input type="text" name="telefono" class="form-control" v-model="telefono" :disabled="isEditing"></td>
                    <td><input type="text" name="direccion" class="form-control" v-model="direccion" :disabled="isEditing"></td>
                    <td><input type="text" name="ciudad" class="form-control" v-model="ciudad" :disabled="isEditing"></td>
                    <td><input type="text" name="pais" class="form-control" v-model="pais" :disabled="isEditing"></td>
                    <td><button @click="crear" class="form-control btn btn-success" :disabled="isEditing">Agregar</button></td>
                </tr>         
                    <tr v-for="(cliente, key) in clientes">
                      <th scope="row">{{clientes.id}}</th>
                        <td :id="cliente.id" v-if="!isEditing || cliente.id != currentId">{{cliente.nombre}}</td>
                        <td v-if="isEditing && cliente.id === currentId"><input type="text" class="form-control" v-model="nombreEdit" :placeholder="cliente.nombre"></td>
                        <td :id="cliente.id" v-if="!isEditing || cliente.id != currentId">{{cliente.apellido}}</td>
                        <td v-if="isEditing && cliente.id === currentId"><input type="text" class="form-control" v-model="apellidoEdit" :placeholder="cliente.apellido"></td>
                        <td :id="cliente.id" v-if="!isEditing || cliente.id != currentId">{{cliente.telefono}}</td>
                        <td v-if="isEditing && cliente.id === currentId"><input type="text" class="form-control" v-model="telefonoEdit" :placeholder="cliente.telefono"></td>
                        <td :id="cliente.id" v-if="!isEditing || cliente.id != currentId">{{cliente.direccion}}</td>
                        <td v-if="isEditing && cliente.id === currentId"><input type="text" class="form-control" v-model="direccionEdit" :placeholder="cliente.direccion"></td>
                        <td :id="cliente.id" v-if="!isEditing || cliente.id != currentId">{{cliente.ciudad}}</td>
                        <td v-if="isEditing && cliente.id === currentId"><input type="text" class="form-control" v-model="ciudadEdit" :placeholder="cliente.ciudad"></td>
                        <td :id="cliente.id" v-if="!isEditing || cliente.id != currentId">{{cliente.pais}}</td>
                        <td v-if="isEditing && cliente.id === currentId"><input type="text" class="form-control" v-model="paisEdit" :placeholder="cliente.pais"></td>
                        <td>
                            <!-- Boton para activar la edicion, se oculta al darle click / Se muestra al darle click a guardar-->
                            <button v-if="!isEditing" class="btn btn-warning btn-circle btn-sm" title="Editar Cliente" @click="editReact(cliente.id)"><i class="fas fa-pen" title="Editar Cliente"></i></button>
                            <!-- Boton para eliminar registro, se oculta al darle click a editiar -->                        
                            <button v-if="!isEditing" type="button" class="btn btn-danger btn-circle btn-sm" title="Eliminar Cliente" @click="drop(cliente.id, cliente.nombre, cliente.apellido)">
                                <i class="fas fa-trash" title="Eliminar Cliente"></i>
                            </button>
                            <!--Boton para Guardar la edicion la edicion se oculta al darle click-->
                            <button v-if="isEditing && cliente.id === currentId" class="btn btn-primary btn-circle btn-sm" title="Guardar" @click="store(cliente.id, cliente.nombre, cliente.apellido, cliente.telefono, cliente.direccion, cliente.ciudad, cliente.pais)"><i class="fas fa-save" title="Guardar"></i></button>
                            <!-- Boton para cancelar guardard/ Se muestra al activar edicion-->
                            <button v-if="isEditing && cliente.id === currentId" class="btn btn-default btn-circle btn-sm" @click="editReact(cliente.id, false)"><i class="fas fa-ban" title="Cancelar"></i></button>
                            
                        </td>
                    </tr>      
                
            </tbody>
        </table>
    </dib>
    `,
  data() {
    return {
      //Data para Creacion de usuarios y  validaciones varias
      nombre: "",
      apellido: "",
      telefono: "",
      direccion: "",
      ciudad: "",
      pais: "",
      isError: false,
      isSuccess: false,
      error: "",
      request: "",
      success: "",
      clientes: [],
      final: {},
      isData: false,
      isEditing: false,
      currentId: -1,
      //Edicion
      nombreEdit: "",
      apellidoEdit: "",
      telefonoEdit: "",
      direccionEdit: "",
      ciudadEdit: "",
      paisEdit: "",
      //Helpers
      URL: "/backend.php",
      //search
      searchText:"",
    };
  },
  methods: {
    /**
     *
     * Metodo para realizar la peticion PUT y actualizar los datos del cliente
     *
     * @param {int} id
     * @param {string} nombre
     * @param {string} apellido
     * @param {string} telefono
     * @param {string} direccion
     * @param {string} ciudad
     * @param {string} pais
     */
    store(id, nombre, apellido, telefono, direccion, ciudad, pais) {
      event.preventDefault();
      axios
        .put("backend.php", {
          id: id,
          nombre: this.realValue(this.nombreEdit, nombre),
          apellido: this.realValue(this.apellidoEdit, apellido),
          telefono: this.realValue(this.telefonoEdit, telefono),
          direccion: this.realValue(this.direccionEdit, direccion),
          ciudad: this.realValue(this.ciudadEdit, ciudad),
          pais: this.realValue(this.paisEdit, pais),
          request: "editar",
        })
        .then(
          (response) => {
            console.log(response.data);
            let datas = response.data;
            if (response.data.code != null && response.data.code == 200) {
              this.message = response.data.message;
              this.isSuccess = true;
              this.updated = true;
              this.isEditing = false;
              this.toast(
                "b-toaster-top-right",
                true,
                response.data.message,
                "success",
                "Hecho!"
              );
              this.consulta();
            } else {
              this.toast(
                "b-toaster-top-right",
                true,
                datas,
                "danger",
                "Error al registrar!"
              );
            }
          },
          (error) => {
            this.toast("b-toaster-top-right", true, error, "danger", "Error!");
          }
        );
      this.consulta();
    },
    /**
     * Ayuda  a controlar la activación y desactivación de los botones
     *
     * @param {int} id
     * @param {boolean} action
     */
    editReact(id, action = true) {
      this.isEditing = action;
      this.currentId = id;
    },
    toast(toaster, append = false, text = null, type, title) {
      let messageType = type;
      let messageTitle = title;
      var texTS;
      texTS = text;

      this.counter++;
      this.$bvToast.toast(`${texTS}`, {
        title: messageTitle,
        toaster: toaster,
        solid: true,
        appendToast: append,
        variant: messageType,
        //noAutoHide: true,
        autoHideDelay: 10000,
      });
      // Reset our form values
      if (type == "success") {
        this.nombre = "";
        this.apellido = "";
        this.telefono = "";
        this.direccion = "";
        this.ciudad = "";
        this.pais = "";
      }
    },
    /**
     * Metodo para registrar un nuevo usuario
     *
     * @param {event} evt
     */
    crear(evt) {
      evt.preventDefault();
      if (this.validarCampos()) {
        axios
          .post("backend.php", {
            nombre: this.nombre,
            apellido: this.apellido,
            telefono: this.telefono,
            direccion: this.direccion,
            ciudad: this.ciudad,
            pais: this.pais,
            request: "registrar",
          })
          .then(
            (response) => {
              console.log(response.data);
              this.message = response.data.message;
              this.isSuccess = true;
              this.updated = true;
              this.toast(
                "b-toaster-top-right",
                true,
                response.data.message,
                "success",
                "Hecho!"
              );
              this.consulta();
            },
            (error) => {
              console.log(error);
            }
          );
      }
    },
    /**
     * Metodo para consultar registros  y cargarla tabla
     */
    consulta() {
      axios.get(this.URL + "?request=todos").then(
        (response) => {
          this.clientes = response.data;
          console.log(response.data);
        },
        (error) => {
          console.log(error);
        }
      );
    },
    /**
     * Metodo para validar que los campos esten llenos
     */
    validarCampos() {
      if (this.nombre == "") {
        this.error = "Por favor ingrese el campo Nombre";
        this.isError = true;
        this.isSuccess = false;
        return false;
      }
      if (this.apellido == "") {
        this.error = "Por favor ingrese el campo Apellido";
        this.isError = true;
        this.isSuccess = false;
        return false;
      }
      if (this.telefono == "") {
        this.error = "Por favor ingrese el campo Telefono";
        this.isError = true;
        this.isSuccess = false;
        return false;
      }
      if (this.direccion == "") {
        this.error = "Por favor ingrese el campo Dirección";
        this.isError = true;
        this.isSuccess = false;
        return false;
      }
      if (this.ciudad == "") {
        this.error = "Por favor ingrese el campo Ciudad";
        this.isError = true;
        this.isSuccess = false;
        return false;
      }
      if (this.pais == "") {
        this.error = "Por favor ingrese el campo País";
        this.isError = true;
        this.isSuccess = false;
        return false;
      }
      this.isError = false;
      this.error = "";
      this.isSuccess = false;
      return true;
    },
    countArray() {
      if (this.clientes == "") {
        this.isData = true;
      }
    },
    /**
     * Metodo para eliminar registro, la eliminacion no sera soft delete
     *
     * @param {int} id
     * @param {string} nombre
     * @param {string} apellido
     */
    drop(id, nombre = null, apellido = null) {
      event.preventDefault();
      if (
        confirm(
          `¿Estas Seguro de querer elimnar a ID:(${id}) ${nombre} ${apellido}?`
        )
      ) {
        axios
          .delete("/backend.php", {
            data: {
              id: id,
            },
          })
          .then(
            (response) => {
              console.log(response.data);
              this.toast(
                "b-toaster-top-right",
                true,
                `${nombre} ${apellido} ha sido eliminado!`,
                "warning",
                "Hecho!"
              );
              if (response.data.code == 200) {
                this.consulta();
              }
            },
            (error) => {
              console.log(error);
            }
          );
      }
    },

    /**
     * Metodo para asegurarse que siempre llegue un valor al backend durante el update
     *
     * @param {mix} model
     * @param {mix} val
     */
    realValue(model, val) {
      if (model == "") {
        return val;
      }
      return model;
    },
    search(){
      axios.post(this.URL, {
        value:this.searchText,
        action: 'search'
      }).then(
        (response) => {
          this.clientes = response.data;
          console.log(response.data)
        },
        (error) => {
          console.log(error);
        }
      );
    }
  },
  mounted() {
    this.consulta();
    this.countArray();
  },
});

let table = new Vue({
  el: "#tab",
  data() {
    return {
      titulo: "Crud Clientes",
      cardTitle: "Clientes",
    };
  },
});