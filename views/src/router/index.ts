import { useAuth } from '@/store/useAuth'
import { RouteRecordRaw, createRouter, createWebHistory } from 'vue-router'

const routes: RouteRecordRaw[] = [
  {
    path: '/',
    component: () => import('@/pages/dashboard/Dashboard.vue'),
    meta: {
      auth: true
    }
  },
  {
    path: '/login',
    component: () => import('@/pages/login/Login.vue')
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes
})
router.beforeEach((to, _, next) => {
  if (to.meta?.auth) {
    const { verifyToken, isLoggedIn } = useAuth()
    if (!isLoggedIn.perm) {
      router.push('/login')
    }
    verifyToken().then(e => {
      if (!e) {
        router.push('/login')
      } else {
        next()
      }
    })
  }
  next()
})
export default router
