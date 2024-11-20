function openModal() {
    document.getElementById("commentModal").style.display = "block";
  }
  
  function closeModal() {
    document.getElementById("commentModal").style.display = "none";
  }
  
  // Modal dışında bir yere tıklayınca kapat
  window.onclick = function (event) {
    const modal = document.getElementById("commentModal");
    if (event.target === modal) {
      modal.style.display = "none";
    }
  };
  