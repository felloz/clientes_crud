let app = new Vue({
  el: "#app",
  data() {
    return {
      titulo: "Crud Clientes",
      titulo_tarjeta: "Agregar Clientes",
      titulo_tarjeta_edit: "Editar Clientes",
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
    };
  },
  props: ["cliente"],
  methods: {
    toast(toaster, append = false, text = null, type, title) {
      let messageType = type;
      let messageTitle = title;
      var texTS;
      if (type == "danger" || type == "warning") {
        for (const key in text) {
          texTS = text[key];
        }
      } else {
        texTS = text;
      }

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
            },
            (error) => {
              console.log(error);
            }
          );
        console.log("creado");
      }
    },
    editar(evt) {
      evt.preventDefault();
      axios
        .put("backend.php", {
          nombre: this.nombre,
          apellido: this.apellido,
          telefono: this.telefono,
          direccion: this.direccion,
          ciudad: this.ciudad,
          pais: this.pais,
          request: "editar",
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
          },
          (error) => {
            console.log(error);
          }
        );
      console.log("editando");
    },
    consulta() {
      axios
        .get("backend.php", {
          request: "consulta",
          tipo: "consulta",
        })
        .then(
          (response) => {
            console.log(response.data);
            this.message = response.data.message;
          },
          (error) => {
            console.log(error);
          }
        );
    },
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
  },
  /* mounted() {
    axios.get("/backend.php?request=consulta").then(
      (response) => {
        console.log(response.data);
        this.rows = response.data;
      },
      (error) => {
        console.log(error);
      }
    );
  },*/
});

/*let editar = new Vue({
  el: "#edit",
  data() {
    return {
      titulo: "Crud Clientes",
      titulo_tarjeta: "Editar Clientes",
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
    };
  },
  methods: {
    editar() {
      axios.get('backend.php', {

      })
    },
  },
});*/
