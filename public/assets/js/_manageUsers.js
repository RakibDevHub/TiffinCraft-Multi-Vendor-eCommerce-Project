document.addEventListener("DOMContentLoaded", () => {
  const vendorsTableBody = document.getElementById("vendorsTableBody");
  const searchInput = document.getElementById("searchInput");
  const statusFilter = document.getElementById("statusFilter");
  const vendorModal = new Modal("vendorModal");

  const vendorName = document.getElementById("vendorName");
  const vendorEmail = document.getElementById("vendorEmail");
  const vendorPhone = document.getElementById("vendorPhone");
  const vendorBusinessName = document.getElementById("vendorBusinessName");
  const vendorBusinessAddress = document.getElementById(
    "vendorBusinessAddress"
  );
  const vendorKitchenType = document.getElementById("vendorKitchenType");
  const vendorDeliveryAreas = document.getElementById("vendorDeliveryAreas");
  const vendorStatus = document.getElementById("vendorStatus");
  const vendorCuisineType = document.getElementById("vendorCuisineType");
  const vendorCreatedAt = document.getElementById("vendorCreatedAt");
  const vendorImage = document.getElementById("vendorImage");

  vendorsTableBody.addEventListener("click", (e) => {
    const row = e.target.closest("tr");

    if (row && row.classList.contains("vendor-row")) {
      vendorName.textContent = row.dataset.name;
      vendorEmail.textContent = row.dataset.email;
      vendorPhone.textContent = row.dataset.phone;
      vendorBusinessName.textContent = row.dataset.businessName;
      vendorBusinessAddress.textContent = row.dataset.businessAddress;
      vendorKitchenType.textContent = row.dataset.kitchenType;
      vendorDeliveryAreas.textContent = row.dataset.deliveryAreas;
      vendorStatus.textContent = row.dataset.status;
      vendorCuisineType.textContent = row.dataset.cuisineType;
      vendorCreatedAt.textContent = row.dataset.createdAt;

      const imagePath = `/uploads/vendors/${row.dataset.outletImage}`;
      vendorImage.src = imagePath;
      vendorImage.alt = row.dataset.name;

      vendorModal.show();
    }
  });

  // Search Vendors
  searchInput.addEventListener("input", filterTable);
  statusFilter.addEventListener("change", filterTable);

  function filterTable() {
    const searchTerm = searchInput.value.toLowerCase();
    const statusValue = statusFilter.value.toLowerCase();

    Array.from(vendorsTableBody.children).forEach((row) => {
      const name = row.dataset.name.toLowerCase();
      const email = row.dataset.email.toLowerCase();
      const businessName = row.dataset.businessName.toLowerCase();
      const status = row.dataset.status.toLowerCase();

      const matchesSearch =
        name.includes(searchTerm) ||
        email.includes(searchTerm) ||
        businessName.includes(searchTerm);

      const matchesStatus = statusValue === "" || status === statusValue;

      row.style.display = matchesSearch && matchesStatus ? "" : "none";
    });
  }
});
