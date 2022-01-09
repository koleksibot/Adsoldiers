export default function({
    $axios,
    store,
    app
}) {
  if (process.client) {
    // onError
    $axios.onError(error => {
        if (!error.response) {
          console.log('Network Error.')
        }
        if (error.response && error.response.status == 422) {
          store.dispatch('validation/setErrors', error.response.data.errors);
        }
        if (error.response && error.response.status == 401) {
          store.dispatch('validation/setErrors', error.response.data)
        }
        if (error.response && error.response.status === 500) {
          store.dispatch('validation/setErrors', error.response.data)
        }
        // if(error.response && error.response.status == 500){
        //   $nuxt.error({
        //     statusCode: 404,
        //     message: 'Page Not Found'
        //   })
        // }

        // return promise so It could be caught after sending our axios request
        let errorPromise = new Promise(function(resolve, reject) {
            reject(error.response.data);
        });       

        return errorPromise;
    })
    // onRequest
    $axios.onRequest(() => {
      store.dispatch('validation/clearErrors')
    })  
  }
}