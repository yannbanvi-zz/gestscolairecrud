
export function useSwalSuccess(message){
    Swal.fire({
        toast: true,
        icon: "success",
        title: message,
        animation: false,
        position: "top-end",
        showConfirmButton: false,
        timer: 4000,
      });
}

export function useSwalError(message){
    Swal.fire({
        toast: true,
        icon: "error",
        title: message,
        animation: false,
        position: "top-end",
        showConfirmButton: false,
        timer: 4000,
      });
}

export function useSwalConfirm(message, callback){
    Swal.fire({
        html: message,
        icon: "warning",
        buttonsStyling: true,
        showCancelButton: true,
        confirmButtonText: "Oui, continuer.",
        cancelButtonText: "Non, fermer.",
        customClass: {
          confirmButton: "btn btn-primary",
          cancelButton: "btn btn-danger",
        },
      }).then((result) => {
        if (result.isConfirmed) {
          callback()
        } else if (result.isDenied) {
          Swal.close();
        }
      });
}