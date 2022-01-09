export default function ({store, redirect}) {
    const role = store.getters['role'];

    if ( role != 'admin' ) {
        return redirect('/');
    }
}