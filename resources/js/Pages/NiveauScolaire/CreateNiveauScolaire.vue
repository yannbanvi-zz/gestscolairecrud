<template>
  <button class="btn btn-primary" data-toggle="modal" data-target="#createNVModal">
    <i class="fa fa-plus"></i> Nouveau
  </button>

  <div
    class="modal fade"
    id="createNVModal"
    data-backdrop="static"
    data-keyboard="false"
    tabindex="-1"
    aria-labelledby="staticBackdropLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Ajout d'un niveau scolaire</h5>
          <button type="button" @click="closeModal" class="close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form @submit.prevent="soumettre" id="createForm">
            <div class="form-group">
              <label for="">Nom</label>
              <input
                type="text"
                required
                class="form-control"
                :class="{'is-invalid': nomError != ''}"
                v-model="nomNiveauScolaire"
              />
              <span v-if="nomError != '' " class="invalid-feedback error">{{ nomError }}</span>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" @click="closeModal">Fermer</button>
          <button form="createForm" type="submit" class="btn btn-success">
            Soumettre
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { useSwalSuccess, useSwalError } from "@/Composables/alert";

const nomNiveauScolaire = ref("");
const nomError = ref("")

let createModal = "";
onMounted(() => {
  createModal = $("#createNVModal");
});

const closeModal = () => {
  createModal.modal("hide");
  nomNiveauScolaire.value = "";
};

const soumettre = () => {
  const nom = nomNiveauScolaire.value;
  const url = route("niveauscolaire.store");
  Inertia.post(
    url,
    { nom },
    {
      onSuccess: (page) => {
        closeModal();
        
        useSwalSuccess("Niveau scolaire ajouté avec succès!")
      },
      onError: (errors) => {
        //Afficher un message d'erreur
        if(errors.nom != null){
            nomError.value = errors.nom
        }
        useSwalError("Une erreur s'est produite")
      },
    }
  );
};
</script>
