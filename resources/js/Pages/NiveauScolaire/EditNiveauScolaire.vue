<template>
    <!-- Modal -->
<div class="modal fade" id="EditModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Edition du niveau scolaire "{{editNiveauScolaire.nom}}"</h5>
        <button type="button" class="close" @click="closeModal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editForm" @submit.prevent="soumettre">
            <div class="form-group">
                <label for="">Nom</label>
              <input
                type="text"
                required
                class="form-control"
                :class="{'is-invalid': editNiveauScolaire.nomError != ''}"
                v-model="editNiveauScolaire.nom"
              />
              <span v-if="editNiveauScolaire.nomError != '' " class="invalid-feedback error">{{ editNiveauScolaire.nomError }}</span>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" @click="closeModal">Fermer</button>
        <button form="editForm" type="submit" class="btn btn-success">Soumettre</button>
      </div>
    </div>
  </div>
</div>

</template>

<script setup>
    import {reactive, watch} from "vue"
    import { Inertia } from "@inertiajs/inertia";
    import { useSwalSuccess, useSwalError } from "@/Composables/alert";

    const emit = defineEmits(["modalClosed"])

    const props = defineProps({
        niveauScolaireId: {
            type: Number,
            required: true
        },
        show: {
            type: Boolean,
            default: false
        }
    })
    const editNiveauScolaire = reactive({
        id: "",
        nom : "",
        nomError: ""
    })

    const soumettre = ()=>{
        Inertia.put(route("niveauscolaire.update", {niveauScolaire: props.niveauScolaireId}), {
            nom: editNiveauScolaire.nom
        }, {
            onSuccess: (response)=>{
                useSwalSuccess("Niveau scolaire mis à jour avec succès!")
                closeModal()
            },
            onError: (error)=>{
                editNiveauScolaire.nomError = error.nom
                useSwalError("Une erreur a été rencontrée")
            }
        })
    }

    const openModal = ()=>{
        getNiveauScolaireById()
        $("#EditModal").modal("show")
    }

    const closeModal = ()=>{
        $("#EditModal").modal("hide")
        emit("modalClosed")
    }

    const getNiveauScolaireById = ()=>{
        axios.get(route("niveauscolaire.edit", { niveauScolaire: props.niveauScolaireId }))
            .then((response)=>{
                editNiveauScolaire.id = response.data.niveauScolaire.id
                editNiveauScolaire.nom = response.data.niveauScolaire.nom
            }).catch((error)=>{
                console.log(error)
            })
    }

    watch(
        () => props.show,
        (newVal, oldVal) =>{
            if(newVal){
                openModal()
            }else{
                closeModal()
            }
        }
    )
</script>