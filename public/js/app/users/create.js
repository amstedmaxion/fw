async function showCreate() {
  document.getElementById("handlePages").innerHTML = await getPage(
    `${APP_URL}/users/create`
  );
  document.getElementById("modalHandlePagesLabel").innerHTML = "Novo Usuário";
  document.getElementById("triggerModalHandlePages").click();
}
