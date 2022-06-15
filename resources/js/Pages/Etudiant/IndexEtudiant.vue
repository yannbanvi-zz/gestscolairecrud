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
                <button class="btn btn-primary">
                  <i class="fa fa-plus"></i> Nouveau
                </button>
              </div>
              <div class="card-tools">
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
                    <th>Etudiant</th>
                    <th>Niveau scolaire</th>
                    <th style="width: 100px"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="etudiant in props.etudiants.data">
                    <td>{{ etudiant.nom }} {{ etudiant.prenom }}</td>
                    <td>{{ etudiant.niveau_scolaire.nom }}</td>
                    <td>
                      <div class="d-flex justify-items-center">
                        <button class="btn btn-info mr-2">
                          <i class="fas fa-pen"></i>
                        </button>
                        <button class="btn btn-danger">
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
const props = defineProps({
  etudiants: Object,
});
</script>
