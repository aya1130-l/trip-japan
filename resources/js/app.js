//app.jsがwebpack.mix.jsで指定したコンパイル対象のファイルなので、
//ほかのjsファイルをここで読み込んでおく
//あるいはwebpackmixで全部コンパイル対象のファイルとして指定してもいい
//今回は前者の方法なのでimportで色々読み込んでる
//crop.jsインポートしたらalpineが死んだ　喧嘩してる、後者の方法ならいけた分からんむず

import './bootstrap';

import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();








