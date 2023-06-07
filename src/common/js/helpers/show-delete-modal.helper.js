function showDeleteModal({ title, onCancel, onAccept }) {
  // Create the main elements
  const modal = document.createElement("div");
  modal.className = "modal position-fixed d-block";
  modal.setAttribute("tabindex", "-1");

  const onClose = () => {
    document.body.style.overflowY = "auto";
    modal.remove();
  };

  const modalDialog = document.createElement("div");
  modalDialog.className = "modal-dialog modal-dialog-centered";

  const modalContent = document.createElement("div");
  modalContent.className = "modal-content";

  // Create the modal header
  const modalHeader = document.createElement("div");
  modalHeader.className = "modal-header";

  const modalTitle = document.createElement("h5");
  modalTitle.className = "modal-title";
  modalTitle.textContent = title;

  modalHeader.appendChild(modalTitle);

  // Create the modal footer
  const modalFooter = document.createElement("div");
  modalFooter.className = "modal-footer";

  const cancelButton = document.createElement("button");
  cancelButton.type = "button";
  cancelButton.className = "btn btn-outline-danger";
  cancelButton.setAttribute("data-bs-dismiss", "modal");
  cancelButton.textContent = "Cancel";
  cancelButton.onclick = function () {
    if (onCancel) onCancel();
    onClose();
  };

  const deleteButton = document.createElement("button");
  deleteButton.type = "button";
  deleteButton.className = "btn btn-danger";
  deleteButton.textContent = "Delete";
  deleteButton.onclick = function () {
    if (onAccept) onAccept();
    onClose();
  };

  modalFooter.appendChild(cancelButton);
  modalFooter.appendChild(deleteButton);

  // Assemble the modal structure
  modalContent.appendChild(modalHeader);
  modalContent.appendChild(modalFooter);
  modalDialog.appendChild(modalContent);
  modal.appendChild(modalDialog);

  // Add the modal to the document body
  document.body.appendChild(modal);
  document.body.style.overflowY = "hidden";
}
