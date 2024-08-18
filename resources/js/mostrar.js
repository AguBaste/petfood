document.addEventListener('DOMContentLoaded',function () {
    const input = document.querySelector('[name="image"]');
    const mini  = document.getElementById('img');
    input.addEventListener('change',function(){
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                mini.src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    })
    
});