function showToast({ title, description, color }) {
  // Create the main elements
  const toastContainer = document.createElement("div");
  toastContainer.className =
    "toast-container position-fixed bottom-0 end-0 p-3";

  const toast = document.createElement("div");
  toast.className = "toast";
  toast.setAttribute("role", "alert");
  toast.setAttribute("aria-live", "assertive");
  toast.setAttribute("aria-atomic", "true");

  // Create the toast header
  const toastHeader = document.createElement("div");
  toastHeader.className = "toast-header";

  const colorSquare = document.createElement("div");
  colorSquare.style.width = "20px";
  colorSquare.style.height = "20px";
  colorSquare.className = "rounded me-2 bg-" + color;

  const strong = document.createElement("strong");
  strong.className = "me-auto";
  strong.textContent = title;

  const closeButton = document.createElement("button");
  closeButton.type = "button";
  closeButton.className = "btn-close";
  closeButton.setAttribute("data-bs-dismiss", "toast");
  closeButton.setAttribute("aria-label", "Close");

  toastHeader.appendChild(colorSquare);
  toastHeader.appendChild(strong);
  toastHeader.appendChild(closeButton);

  // Create the toast body
  const toastBody = document.createElement("div");
  toastBody.className = "toast-body";
  toastBody.textContent = description;

  toast.appendChild(toastHeader);
  toast.appendChild(toastBody);
  toast.setAttribute("data-bs-delay", "2000");
  toastContainer.appendChild(toast);
  const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toast);
  toastBootstrap.show();
  setTimeout(() => {
    toastContainer.remove();
  }, 3000);
  // Add the toast container to the document body
  document.body.appendChild(toastContainer);
}
