<p class="text-gray-800">image:</p>


<div x-data="inputFormHandler()">
    <div class="hscroll flex items-center justify-center mb-4">
        <i class="left arrow cursor-pointer fa fa-chevron-left md:mr-10 mr-5 text-gray-500 md:text-[50px] text-[20px]" aria-hidden="true"></i><!--矢印-->
        
        <ul id="tmpimage" class="hidden w-[250px]"></ul>
        <img id="defaultimage" src="/src/image/画像.png" class="w-[250px] mt-2">
        
        <i class="right arrow cursor-pointer fa fa-chevron-right md:ml-10 ml-5 text-gray-500 md:text-[50px] text-[20px]" aria-hidden="true"></i><!--矢印-->
    </div>

    <template x-for="(field, i) in fields" :key="i"><!--繰り返し-->
        <div class="w-full flex my-2">
            <label :for="field.id" class="border border-gray-300 rounded-md p-2 w-full bg-white cursor-pointer">
                <input type="file" accept="image/*" class="sr-only" :id="field.id" name="preimages[]" @change="fields[i].file = $event.target.files[0]" onchange="previewImg(this)" >
                <span x-text="field.file ? field.file.name : '画像を選択'" class="text-gray-700"></span>
            </label>
            <button type="reset" @click="removeField(i)" class="p-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500 hover:text-red-700" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    </template>

    <template x-if="fields.length < 10">
        <button type="button" @click="addField()" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-500 hover:bg-gray-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
            </svg>
            <span>画像を追加</span>
        </button>
    </template>
</div>

<script>
let j = 0;

function inputFormHandler() {
    return {
    fields: [],
    addField() {
        const i = this.fields.length;
        j++;
        this.fields.push({
        file: '',
        id: `input-image-${j}`
        });
    },
    removeField(index) {
        const id = this.fields[index].id;
        const previewImg = document.getElementById('image-'+id+'');
        const fields = this.fields;
        const remove = new Promise(function(resolve){
            fields.splice(index, 1);//フィールド削除
            previewImg.remove();//プレビュー削除

            containFields = fields.filter(function(file){return file.file != ''});
            containFieldsLength = containFields.length;
            resolve(containFieldsLength);
        });
        remove.then(function(containFieldsLength){//プレビュー画像が0になったらデフォルト画像表示
            if(containFieldsLength == 0){
                document.getElementById('defaultimage').classList.remove('hidden');
                document.getElementById('tmpimage').classList.add('hidden');
            }  
        });
    },
    }
}

function previewImg(obj){   
    //preview表示場所のデフォルト画像の表示・非表示  
    document.getElementById('defaultimage').classList.add('hidden');
    document.getElementById('tmpimage').classList.remove('hidden');

    //既にファイル選択済みのフィールドから画像選択されたとき、以前のpreview削除
    const id = event.target.id;
    const beforePreviewImage = document.getElementById('image-'+id+'');
    if(beforePreviewImage){beforePreviewImage.remove()};

    const image = new Image();//imageには引数でwidth,heightの指定可能、指定しなければnatural
    const fileReader = new FileReader();
    const file = obj.files[0];
    const tmpimage = document.getElementById('tmpimage');
        
    fileReader.onload = function (e) {
        image.onload = function (){
            const canvas = document.createElement('canvas');
            const ctx = canvas.getContext('2d');
            //どのサイズで保存するか
            canvas.width = 400;
            canvas.height = 400;
            const canvasWidth = canvas.width;
            const canvasHeight = canvas.height;
            const canvasAspect = canvasWidth/canvasHeight;

            const imageWidth = image.width;
            const imageHeight = image.height;
            const imageAspect = imageWidth/imageHeight;
            let sx,sy,sw,sh;
            
            if(canvasAspect >= imageAspect){
                const ratio = canvasWidth / imageWidth;
                sx = 0;
                sy = ( imageHeight * ratio - canvasHeight ) / ratio / 2;
                sw = imageWidth;
                sh = canvasHeight / ratio;
            } else {
                const ratio = canvasHeight / imageHeight;
                sx = ( imageWidth * ratio - canvasWidth ) / ratio / 2;
                sy = 0;
                sw = canvasWidth / ratio;
                sh = imageHeight;
            }
            ctx.drawImage(image, sx, sy, sw, sh, 0, 0, canvasWidth, canvasHeight);//対象のimageをリサイズ
            resizedImgUrl = canvas.toDataURL('image/png');//base64作成
            tmpimage.innerHTML += '<li><img id="image-'+ id +'" src="' + resizedImgUrl + '" class="w-[250px] mt-5"></li>';
        }   
        image.src = e.target.result;
    }
    fileReader.readAsDataURL(file);
}

//スクロール
const leftelm =document.querySelector('.left');
leftelm.onclick = function () {
    let ul = leftelm.parentNode.querySelector('ul');
    ul.scrollLeft -= ul.clientWidth;//要素の内容が左端からスクロールするピクセル数
};
    
const rightelm = document.querySelector('.right');
rightelm.onclick = function () {
    let ul = rightelm.parentNode.querySelector('ul');
    ul.scrollLeft += ul.clientWidth;
};
</script>

<style>
.hscroll ul {
	overflow:hidden;
    white-space:nowrap;
	scroll-snap-type:x mandatory;
	scroll-behavior:smooth;
}


.hscroll li {
	list-style:none;
	display:inline-block;
}



@media screen and (max-width:480px) {
	.hscroll ul {
		overflow-x:auto;
	}
}
</style>