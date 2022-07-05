<template>
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Liste de tous les étudiants</h1>
        </div>
      </div>
    </div>
  </div>

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <div class="card-title">
                <Link :href="route('etudiant.create')" class="btn btn-primary mb-4">
                  <i class="fa fa-plus"></i> Nouveau
                </Link>
                <select @change="search" v-model="per_page"  class="form-control">
                    <option  disabled selected>par page</option>
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    </select>
              </div>
              <div class="card-tools ">
              
                <Pagination
                  :links="props.etudiants.links"
                  :prev="props.etudiants.prev_page_url"
                  :next="props.etudiants.next_page_url"
                />
              </div>
            </div>

            <div class="card-body p-0">
              <table class="table">
                <thead>
                  <tr>
                  <th>
                  </th>
                    <th>
                    <p>Etudiant</p>
                    <input @keyup="search" v-model="searchEtudiant" type="text" class="form-control">
                    </th>
                    <th>
                    <p>Niveau scolaire</p>
                    <select @change="search" v-model="filtreNiveauScolaire"  class="form-control">
                    <option value=""></option>
                    <option :value="niveauscolaire.id" :key="niveauscolaire.id" v-for="niveauscolaire in props.niveauScolaires">{{ niveauscolaire.nom }}</option>
                    </select>
                    </th>
                    <th style="width: 100px"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="etudiant in props.etudiants.data">
                  <td>
                    <img :src="showPic(etudiant)" alt="" style="width:45px; height:45px; border-radius: 25px;">
                  </td>
                    <td>{{ etudiant.nom }} {{ etudiant.prenom }}</td>
                    <td>{{ etudiant.niveau_scolaire.nom }}</td>
                    <td>
                      <div class="d-flex justify-items-center">
                        <Link :href="route('etudiant.edit', {etudiant: etudiant.id})" class="btn btn-info mr-2">
                          <i class="fas fa-pen"></i>
                        </Link>
                        <button class="btn btn-danger" @click="deleteConfirmation(etudiant)">
                          <i class="fas fa-trash"></i>
                        </button>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import Pagination from "../../Shared/Pagination.vue";
import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { useSwalConfirm, useSwalSuccess, useSwalError  } from "../../Composables/alert";

const props = defineProps({
  etudiants: Object,
  niveauScolaires: Array,
  filtres: Object
});

const searchEtudiant = ref(props.filtres.search ?? "")
const filtreNiveauScolaire = ref(props.filtres.filter ?? "")
const per_page = ref(props.filtres.per_page ?? 5)

const showPic = (etudiant)=>{
  if(etudiant.photo){
    return 'storage/'+etudiant.photo
  }
  return etudiant.sexe == "M" ? "images/man.jpeg" : "images/woman.jpeg"
}

const deleteEtudiant = (id) => {
  Inertia.delete(route("etudiant.delete", { etudiant: id }), {
    onSuccess: (response) => {
      useSwalSuccess("Etudiant supprimé avec succès!");
    },
    onError: (error) => {
      useSwalError(error.message ?? "Une erreur a été rencontrée");
    },
  });
};

const deleteConfirmation = (etudiant) => {
  const message =
    `Vous êtes sur le point de supprimer l'étudiant "${etudiant.nom} ${etudiant.prenom}", voulez-vous continuer?`;
  useSwalConfirm(message, () => {
    deleteEtudiant(etudiant.id);
  });
};

const search = _.throttle(function(){
  console.log("searchEtudiant : ", searchEtudiant.value )
  console.log("filter : ", filtreNiveauScolaire.value)
  console.log("per_page : ", per_page.value)

  Inertia.get(route("etudiant.index", { search: searchEtudiant.value, filter: filtreNiveauScolaire.value, per_page: per_page.value }), {}, {
    replace: true,
    preserveState: true
  })
}, 500)
</script>
