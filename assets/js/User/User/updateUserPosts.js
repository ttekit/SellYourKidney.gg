window.addEventListener("load", () => {
    $updateBtns = $(".updateBtn");
    $deleteBtns = $(".deleteBtn");
    $updateBtns.on("click", (e) => {
        let id = $(e.target).parents(".dataContainer").find(".id").val();
        console.log(`/user/updateOnePost/?id=${id}`);
        location.href = `/user/updateOnePost/?id=${id}`;
    })
    $deleteBtns.on("click", (e) => {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#22ec33',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                let container = $(e.target).parents(".dataContainer");
                $.ajax({
                    url: "/AdminAjax/deleteOnePost",
                    method: "post",
                    data: {
                        postId: container.find(".id").val()
                    },
                    success: (res) => {
                        if (res === "POST_REMOVED") {
                            Swal.fire(
                                'Good job!',
                                'You deleted your own post!',
                                'success'
                            )
                            container.remove();
                        }
                    },
                    error: (err) => {
                        console.log(err)
                    }
                })
            }
        })
    })
})