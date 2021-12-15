function previewImgLokasi() {
  const fotoLokasi = document.querySelector("#foto_lokasi");
  const imgPreview = document.querySelector(".img-preview-lokasi");
  const fileFotoLokasi = new FileReader();
  fileFotoLokasi.readAsDataURL(fotoLokasi.files[0]);
  fileFotoLokasi.onload = function (e) {
    imgPreview.src = e.target.result;
  };
}

function previewImgDiri() {
  const fotoDiri = document.querySelector("#foto_diri");
  const imgPreview = document.querySelector(".img-preview-diri");
  const fileFotoDiri = new FileReader();
  fileFotoDiri.readAsDataURL(fotoDiri.files[0]);
  fileFotoDiri.onload = function (e) {
    imgPreview.src = e.target.result;
  };
}

function previewImgKtp() {
  const fotoKtp = document.querySelector("#foto_ktp");
  const imgPreview = document.querySelector(".img-preview-ktp");
  const fileFotoKtp = new FileReader();
  fileFotoKtp.readAsDataURL(fotoKtp.files[0]);
  fileFotoKtp.onload = function (e) {
    imgPreview.src = e.target.result;
  };
}

function previewImgKk() {
  const fotoKk = document.querySelector("#foto_kk");
  const imgPreview = document.querySelector(".img-preview-kk");
  const fileFotoKk = new FileReader();
  fileFotoKk.readAsDataURL(fotoKk.files[0]);
  fileFotoKk.onload = function (e) {
    imgPreview.src = e.target.result;
  };
}

function previewImgProfile() {
  const fotoProfile = document.querySelector("#user_image");
  const imgPreview = document.querySelector(".img-preview-user");
  const fileFotoProfile = new FileReader();
  fileFotoProfile.readAsDataURL(fotoProfile.files[0]);
  fileFotoProfile.onload = function (e) {
    imgPreview.src = e.target.result;
  };
}

function previewImgInfo1() {
  const fotoInfo1 = document.querySelector("#foto_info1");
  const imgPreview = document.querySelector(".img-preview-info1");
  const fileFotoInfo1 = new FileReader();
  fileFotoInfo1.readAsDataURL(fotoInfo1.files[0]);
  fileFotoInfo1.onload = function (e) {
    imgPreview.src = e.target.result;
  };
}

function previewImgInfo2() {
  const fotoInfo2 = document.querySelector("#foto_info2");
  const imgPreview = document.querySelector(".img-preview-info2");
  const fileFotoInfo2 = new FileReader();
  fileFotoInfo2.readAsDataURL(fotoInfo2.files[0]);
  fileFotoInfo2.onload = function (e) {
    imgPreview.src = e.target.result;
  };
}

function previewImgInfo3() {
  const fotoInfo3 = document.querySelector("#foto_info3");
  const imgPreview = document.querySelector(".img-preview-info3");
  const fileFotoInfo3 = new FileReader();
  fileFotoInfo3.readAsDataURL(fotoInfo3.files[0]);
  fileFotoInfo3.onload = function (e) {
    imgPreview.src = e.target.result;
  };
}

function previewImgLain() {
  const fotoLain = document.querySelector("#foto_lain");
  const imgPreview = document.querySelector(".img-preview-lain");
  const fileFotoLain = new FileReader();
  fileFotoLain.readAsDataURL(fotoLain.files[0]);
  fileFotoLain.onload = function (e) {
    imgPreview.src = e.target.result;
  };
}
