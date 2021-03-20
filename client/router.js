import Vue from 'vue'
import Router from 'vue-router'
import { scrollBehavior } from '~/utils'

Vue.use(Router)

const page = path => () => import(`~/pages/${path}`).then(m => m.default || m)

const routes = [
  { path: '/', redirect: { name: 'mail.list' } },
  {
    path: '/mail',
    component: page('mail/Index.vue'),
    children: [
      { path: '', redirect: { name: 'mail.list' } },
      { path: 'compose', name: 'mail.compose', component: page('mail/Compose.vue') },
      { path: 'list', name: 'mail.list', component: page('mail/List.vue') }
    ]
  }
]

export function createRouter () {
  return new Router({
    routes,
    scrollBehavior,
    mode: 'history'
  })
}
