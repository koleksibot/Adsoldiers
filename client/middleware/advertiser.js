export default function({ store, redirect }) {
  const role = store.getters["role"];

  if (role != "advertiser") {
    return redirect("/");
  }
}
