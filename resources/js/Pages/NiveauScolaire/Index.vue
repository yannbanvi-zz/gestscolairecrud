<template>
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Liste de tous les niveaux scolaires</h1>
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
              <h3 class="card-title"></h3>
              <div class="card-tools">
                <ul class="pagination pagination-sm float-right">
                  <li class="page-item"><a class="page-link" href="#">«</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">»</a></li>
                </ul>
              </div>
            </div>

            <div class="card-body p-0">
              <table class="table">
                <thead>
                  <tr>
                    <th>Nivau scolaire</th>
                    <th style="width: 100px"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="niveauScolaire in props.niveauScolaires">
                    <td>{{niveauScolaire.nom}}</td>
                    <td>
                          <div class="d-flex justify-items-center">
                          <button class="btn btn-info mr-2"><i class="fas fa-pen"></i></button>
                          <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
  const props = defineProps({
    niveauScolaires: Array
  })
</script>
