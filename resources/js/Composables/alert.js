
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