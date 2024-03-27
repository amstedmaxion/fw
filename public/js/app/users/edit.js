async function showEdit(id) {
  document.getElementById("handlePages").innerHTML = await getPage(
    `${APP_URL}/users/edit/${id}`
  );
  document.getElementById("modalHandlePagesLabel").innerHTML = "Alterar Usuário";
  document.getElementById("triggerModalHandlePages").click();
}

function destroyConfirm(id) {
  dyoxfy(
    "warning",
    `Realmente deseja excluir o usuário? <br> <a href="${APP_URL}/users/delete/${id}">Confirmar exclusão</a>`
  );
}
