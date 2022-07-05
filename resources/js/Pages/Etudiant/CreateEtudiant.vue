<template>
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
        </div>
      </div>
    </div>
  </div>

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <div class="card card-primary">
            <div class="card-header">
            <h3 class="card-title">
            Ajout d'un etudiant
            </h3>
            </div>
            <div class="card-body">
              <form @submit.prevent="soumettre" id="formulaire">
                <div class="form-group">
                  <label for="">Nom :</label>
                  <input required type="text" :class="{'is-invalid': form.errors.nom}" class="form-control" v-model="form.nom">
                   <span v-if="form.errors.nom" class="invalid-feedback error">{{ form.errors.nom }}</span>
                </div>
                <div class="form-group">
                  <label for="">Prenom :</label>
                  <input required type="text" :class="{'is-invalid': form.errors.prenom}" class="form-control" v-model="form.prenom">
                   <span v-if="form.errors.prenom" class="invalid-feedback error">{{ form.errors.prenom }}</span>
                </div>
                <div class="form-group">
                  <label for="">Sexe</label>
                  <select class="form-control" :class="{'is-invalid': form.errors.sexe}" id="" v-model="form.sexe">
                    <option value=""></option>
                    <option value="M">Masculin</option>
                    <option value="F">Feminin</option>
                  </select>
                   <span v-if="form.errors.sexe" class="invalid-feedback error">{{ form.errors.sexe }}</span>
                </div>

                <div class="form-group">
                  <label for="">Age :</label>
                  <input required type="number" :class="{'is-invalid': form.errors.age}" class="form-control" v-model="form.age">
                   <span v-if="form.errors.age" class="invalid-feedback error">{{ form.errors.age }}</span>
                </div>

                <div class="form-group">
                  <label for="">Niveau scolaire</label>
                  <select class="form-control" :class="{'is-invalid': form.errors.niveauScolaire}" id="" v-model="form.niveauScolaire">
                    <option value=""></option>
                    <option :value="nv.id" :key="nv.id" v-for="nv in props.niveauScolaires">{{ nv.nom }}</option>
                  </select>
                   <span v-if="form.errors.niveauScolaire" class="invalid-feedback error">{{ form.errors.niveauScolaire }}</span>
                </div>

                <div class="d-flex justify-content-between">
                <div class="form-group">
                  <label for="">Photo :</label>
                  <input :key="inputKey"  type="file" accept="image/*" class="form-control" @input="previewImage($event)">
                </div>
                <div>
                  <img src="" alt="" id="image-preview" style="width:75px;height:75px; border-radius:25px; display:none;">
                </div>
                </div>
              </form>
            </div>
            <div class="card-footer">
              <button  class="btn btn-success" form="formulaire">Soumettre</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script setup>

import { useForm } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';
import { useSwalSuccess, useSwalError } from '../../Composables/alert';

const props = defineProps({
  niveauScolaires: Array
})

const inputKey = ref(0);

const form = useForm({
  nom: "",
  prenom: "",
  sexe: "",
  age: "",
  niveauScolaire: "",
  photo: null,
})

const soumettre = ()=>{
  form.post(route("etudiant.store"), {
    onSuccess: (page)=>{
      useSwalSuccess("Etudiant ajouté avec succès!")
      form.reset()
      inputKey.value += 1
      document.getElementById("image-preview").style.display = "none";
    },
    onError: (errors)=>{
      useSwalError("Une erreur s'est produite.")
    }
  })
}

const previewImage = (event)=>{
  if(event.target.files.length>0){
    form.photo = event.target.files[0]
    var src = URL.createObjectURL(event.target.files[0])
    var previewImage = document.getElementById("image-preview")
    previewImage.src = src
    previewImage.style.display = "block"
  }
}
</script>
