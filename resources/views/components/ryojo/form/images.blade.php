<div class="items-center">
  <p class="text-gray-800">image:</p>
   <label for="preview">
    <span class="relative text-white bg-gray-500 hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center pointer-events-auto cursor-pointer">
    画像を追加する(10枚まで)
    <svg class="ml-2 w-4 h-4" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg> 
    <input type="file" accept="image/*" class="sr-only" id="preview" onchange="previewImage(this)" multiple>
  </span>
  </label>
  <a onclick="reset()" class="text-sm text-gray-800 underline cursor-pointer md:ml-2 whitespace-nowrap">選択を解除</a>
  <span id="imgalert" class="hidden text-sm text-red-500">画像が10枚を超えています</span>
</div>

<div id="output" class="hidden"></div><!--送信するデータ-->

<div class="hscroll flex items-center justify-center mt-2">
  <i class="left arrow cursor-pointer fa fa-chevron-left md:mr-10 mr-5 text-gray-500 md:text-[50px] text-[20px]" aria-hidden="true"></i><!--矢印-->
  
  <ul id="tmpimage" class="hidden w-[250px]"></ul>
  <img id="defaultimage" src="/src/image/画像.png" class="w-[250px] mt-5">
  
  <i class="right arrow cursor-pointer fa fa-chevron-right md:ml-10 ml-5 text-gray-500 md:text-[50px] text-[20px]" aria-hidden="true"></i><!--矢印-->
</div>



<script>
    const output = document.getElementById('output');
    const tmpimage = document.getElementById('tmpimage');
    const inputTemplate = document.createElement('input');
    inputTemplate.type = 'file';
    inputTemplate.name ='images[]';

    function previewImage(obj)
    {
      if(obj.files.length = 0){
        document.getElementById('defaultimage').classList.remove('hidden');
        document.getElementById('tmpimage').classList.add('hidden');
      }else{
        document.getElementById('defaultimage').classList.add('hidden');
        document.getElementById('tmpimage').classList.remove('hidden');
      };

      if(output.childElementCount > 10){
        document.getElementById('imgalert').classList.remove('hidden');
      }
      else{
        document.getElementById('imgalert').classList.add('hidden');
      };

      for (j = 0; j < obj.files.length; j++) {//canvasに描画、描画した内容を出力して送信する
        const image = new Image();//imageには引数でwidth,heightの指定可能、指定しなければnatural
        const fileReader = new FileReader();
        fileReader.onload = function (e) {
          image.onload = function (){
          const canvas = document.createElement('canvas');
          const ctx = canvas.getContext('2d');
          //どのサイズで保存するか
          canvas.width = 400;
          canvas.height = 300;
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
          ctx.drawImage(image, sx, sy, sw, sh, 0, 0, canvasWidth, canvasHeight);
          resizedImgUrl = canvas.toDataURL('image/png');//base64作成
          tmpimage.innerHTML += '<li><img src="' + resizedImgUrl + '" class="w-[250px] mt-5"></li>';

          //base64をファイルに変換し、inputにセット
          const input = inputTemplate.cloneNode(false);
          const dt = new DataTransfer();
          const bin = atob(resizedImgUrl.replace(/^.*,/, '')); //ファイルをバイナリ化           
          const buffer = new Uint8Array(bin.length);//バイナリデータに変換する
          for (let i = 0; i < bin.length; i++) {
              buffer[i] = bin.charCodeAt(i);
          }
          const resizedImg = new File([buffer.buffer],"filename",{type:"image/png"});//Fileオブジェクトを生成
          dt.items.add(resizedImg);
          input.files = dt.files;
          output.appendChild(input);

          if(output.childElementCount > 10){
            document.getElementById('imgalert').classList.remove('hidden');
          }
          else{
            document.getElementById('imgalert').classList.add('hidden');
          };
          
          }
          image.src = e.target.result;
        }
        fileReader.readAsDataURL(obj.files[j]);
      }
    }


    //画像リセット
    function reset(){
      while (output.firstChild) {
      output.removeChild(output.firstChild);
      }
      while (tmpimage.firstChild) {
        tmpimage.removeChild(tmpimage.firstChild);
      }
      document.getElementById('defaultimage').classList.remove('hidden');
      document.getElementById('tmpimage').classList.add('hidden');
      document.getElementById('preview').value = '';
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









