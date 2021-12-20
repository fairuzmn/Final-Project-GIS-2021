let map;
const API_URL = "api/places.php";
const listRsDiv = $("#listRsDiv");
const btnTambahData = $("#btnTambahData");
let globalArrLokasi = [];
let globalArrMarker = [];
let infowindowNow;
let markerNow;
let myMarkerNow;
let myInfoWindowNow;

function initMap(lat, lng) {
  let myLatLng = new google.maps.LatLng(lat, lng);
  map = new google.maps.Map(document.getElementById("map"), {
    center: myLatLng,
    zoom: 13,
  });

  let myMarkLoc = new google.maps.Marker({
    position: myLatLng,
    title: "Lokasi Anda",
    optimized: true,
    icon: "assets/images/64px/current-location.png",
  });

  const myInfoWindowLoc = new google.maps.InfoWindow({
    content: "Lokasi Anda",
  });

  myMarkLoc.setMap(map);
  myMarkerNow = myMarkLoc;
  myInfoWindowNow = myInfoWindowLoc;
  setTimeout(() => {
    $(".dismissButton").click();
  }, 2000);
}

function initPlacesMarker() {
  listRsDiv.html("");
  globalArrLokasi.forEach((rs, index) => {
    const el = cardElement(rs, index);
    listRsDiv.append(el);
    const lat = parseFloat(rs.lat);
    const lng = parseFloat(rs.lng);
    const marker = new google.maps.Marker({
      position: { lat, lng },
      map,
      title: rs.title,
      animation: google.maps.Animation.DROP,
      optimized: true,
      icon: "assets/images/64px/rs-location.png",
    });
    marker.addListener("click", () => markerClick(marker, rs.id));
    globalArrMarker.push(marker);
  });
}

function markerClick(marker, idrs = "") {
  if (markerNow != null || infowindowNow != null) {
    infowindowNow.close(map, marker);
    markerNow.setAnimation(null);
    myMarkerNow.setAnimation(null);
  }
  marker.setAnimation(google.maps.Animation.BOUNCE);
  map.setZoom(13);
  map.setCenter(marker.getPosition());
  changeSelectedCard(idrs);
  if (idrs == "") {
    myInfoWindowNow.open(map, marker);
    return;
  }
  myInfoWindowNow.close(map, marker);
  const selectedRs = globalArrLokasi.find((item) => item.id == idrs);
  let infowindow = new google.maps.InfoWindow({
    content: selectedRs.nama,
  });
  infowindow.open(map, marker);
  infowindowNow = infowindow;
  markerNow = marker;
}

function changeSelectedCard(id) {
  $(".cardx").css("border", "1px solid rgba(0,0,0,.125)");
  $("#card_" + id).css("border", "1.5px solid red");
}

function changeMarkerFocus(idrs, indexMarker) {
  const marker = globalArrMarker[indexMarker];
  markerClick(marker, idrs);
}

function initData() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(async (position) => {
      const { latitude, longitude } = position.coords;
      initMap(latitude, longitude);
      initDataMarker();
    });
  } else {
    alert("Location Not Found");
  }
}

async function initDataMarker() {
  if (globalArrMarker.length > 0) {
    globalArrMarker.forEach((marker) => {
      marker.setMap(null);
    });
  }

  let res = await $.post(API_URL, { r: "get" });
  globalArrLokasi = JSON.parse(res);
  globalArrMarker = [];
  initPlacesMarker();
}

function cardElement(rs, index) {
  const { id, nama, alamat } = rs;
  return `<div class="card mb-3 cardx" id="card_${id}" style="cursor:pointer" onclick="changeMarkerFocus(${id},${index})">
                <div class="card-body">
                    <h5 class="card-title">${nama}</h5>
                    <p class="card-text">${alamat}</p>
                    <button type="button" class="btn btn-sm btn-primary" onclick="handleEditData(${id})"> <i class="bi-pencil-square"></i> Edit</button>
                    <button type="button" class="btn btn-sm btn-danger" onclick="handleDeleteData(${id})"><i class="bi-trash"></i> Hapus</button>
                </div>
            </div>`;
}

function getFormData() {
  const id = $("#id").val();
  const nama = $("#nama").val();
  const alamat = $("#alamat").val();
  const lat = $("#lat").val();
  const lng = $("#lng").val();

  if (nama == "" || alamat == "" || lat == "" || lng == "") {
    alert("Lengkapi Data!");
    return null;
  }

  return { id, nama, alamat, lat, lng };
}

function fillFormData(id, nama, alamat, lat, lng) {
  $("#id").val(id);
  $("#nama").val(nama);
  $("#alamat").val(alamat);
  $("#lat").val(lat);
  $("#lng").val(lng);
}

async function handleSaveData() {
  const formData = getFormData();
  if (!formData) return;
  const r = formData.id == "0" ? "add" : "edit";
  let res = await $.post(API_URL, { ...formData, r });
  res = JSON.parse(res);
  if (!res.success) {
    alert(`Kesalahan saat ${r} data`);
    return;
  }

  initDataMarker();
  toggleModal();
}
function toggleModal() {
  $("#modalForm").modal("toggle");
}

function handleAddData() {
  $("#formTitle").html("Tambah Lokasi");
  fillFormData("0", "", "", "", "");
  toggleModal();
}

function handleEditData(idrs) {
  $("#formTitle").html("Edit Lokasi");
  const selectedRs = globalArrLokasi.find((item) => item.id == idrs);
  const { id, nama, alamat, lat, lng } = selectedRs;
  fillFormData(id, nama, alamat, lat, lng);
  toggleModal();
}

async function handleDeleteData(idrs) {
  const selectedRs = globalArrLokasi.find((item) => item.id == idrs);
  if (confirm(`Yakin ingin menghapus ${selectedRs.nama} ?`)) {
    let res = await $.post(API_URL, { r: "remove", id: selectedRs.id });
    res = JSON.parse(res);
    if (res.success) {
      alert(`Berhasil Hapus ${selectedRs.nama}`);
      initDataMarker();
    } else {
      alert(`Gagal Hapus ${selectedRs.nama}, coba lagi nanti!`);
    }
  }
}

function handleMyLocation() {
  markerClick(myMarkerNow);
}
