const form = document.querySelector("form"),
commentBtn = form.querySelector("input[type=submit]"),
commentText = document.querySelector(".comment");

// errorText = form.querySelector(".error-text");

form.onsubmit = (e)=>{
    e.preventDefault();
}
// setInterval(() =>{
//     let xhr = new XMLHttpRequest();
//     xhr.open("GET", "/comment", true);
//     xhr.onload = ()=>{
//       if(xhr.readyState === XMLHttpRequest.DONE){
//           if(xhr.status === 200){
//             let data = xhr.response;
//             data.forEach((element) => {
//                 console.log(element["name"]);
//             });
//           }
//       }
//     }
//     xhr.send();
//   }, 500);



commentBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open('POST', "/comment", true);
    xhr.onload = ()=>{
        if (xhr.readyState===XMLHttpRequest.DONE) {
            if (xhr.status==200) {
                let data = xhr.response
                console.log(data);
                if (data == 'success') {

                    alert("Comment posted successfully")
                    window.location.reload()
                }
                else{
                    alert("An error has occurred Please try again later");

                }
            }
        }
    }
    let formdata = new FormData(form);
    xhr.send(formdata);
}

// commentBtn.onclick = ()=>{
//     console.log("Hi Checking...");
// }
