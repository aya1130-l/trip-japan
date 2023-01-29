<x-layoutgray title="旅情　-画像の編集-">
    <p class="text-center mt-24  text-lg text-gray-800">< 画像の編集 ></p>
    <div class="md:w-[650px] w-11/12 min-h-[400px] m-auto mt-4 border-4 border-gray-400 bg-white rounded-lg">
        <div class="m-auto mt-4 w-5/6">
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
        </div>
            <div class="my-12 text-center">
                <x-ryojo.form.images></x-ryojo.form.images>
            </div>
        </div>
    <button type="submit" onclick="postImg()" class="block w-1/2 md:w-1/4 h-12 m-auto my-20 bg-[#001a1a] hover:bg-[#1e3333] text-center text-white rounded-lg">次へ</button>
</x-layoutgray>

<script>
function setImg(){
    return new Promise(function(resolve){
        const resizedImgs = document.querySelectorAll(`[id^='image-']`);
        const ImgUrls = [];
        const ImgFiles = [];

        resizedImgs.forEach((resizedImg,i) => {
            Url = resizedImg.src;
            ImgUrls.push(Url);
        });

        ImgUrls.forEach((ImgUrl,i) => {     
            const bin = atob(ImgUrl.replace(/^.*,/, '')); //baseをバイナリ化           
            const buffer = new Uint8Array(bin.length);//バイナリデータに変換する
            for (let i = 0; i < bin.length; i++) {
                    buffer[i] = bin.charCodeAt(i);
                }
            const ImgFile = new File([buffer.buffer],ImgUrl,{type:"image/png"});//Fileオブジェクトを生成
            ImgFiles.push(ImgFile);
        });
    resolve(ImgFiles);
    });
}

async function postImg(){
    const ImgFiles = await setImg();

    const form = document.createElement("form");
    form.action = "{{ route('ryojo.update.imageconfirm',['memoryId' => $memory->id]) }}";
    form.method = "POST";
    form.enctype="multipart/form-data";

    const formData = new FormData();
    ImgFiles.forEach((ImgFile,i) => {
        formData.append("images[]",ImgFile);
        });

    form.addEventListener("formdata",e =>{
        for(const[name,value] of formData.entries()){
            e.formData.append(name,value)
        }
    })

    document.body.append(form);

    const input = document.createElement('input');
    const csrf = document.querySelector('meta[name="csrf-token"]').content;
    input.setAttribute('type','hidden');
    input.setAttribute('name','_token');
    input.setAttribute('value',csrf);

    form.appendChild(input);

    form.submit(); 
}
</script>
