import axios from 'axios'
import Swal from 'sweetalert2'

// process.env.NODE_TLS_REJECT_UNAUTHORIZED = '0'

export default ({ app, store, redirect }) => {
  axios.defaults.baseURL = process.env.apiUrl

  if (process.server) {
    return
  }

  // Request interceptor
  axios.interceptors.request.use((request) => {
    request.baseURL = process.env.apiUrl

    return request
  })

  // Response interceptor
  axios.interceptors.response.use(response => response, (error) => {
    const { status } = error.response || {}

    if (status >= 500) {
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Server Error Occured',
        reverseButtons: true,
        confirmButtonText: 'Ok',
        cancelButtonText: 'Cancel'
      })
    }

    return Promise.reject(error)
  })
}
