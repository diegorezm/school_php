import http from "@/config/axios/http";
import { BaseError } from "@/error/error";
import { AuthError } from "@/lib/api/auth/errors/AuthError";
import { Token, User } from "@/lib/api/auth/interface";
import { defineStore } from "pinia";
import { reactive, ref } from "vue";

export const useAuth = defineStore('auth', () => {
  const token = ref<Token | null>(getToken())
  const user = ref<User | null>(getUser())
  const isLoggedIn = reactive( { perm: token.value !== null } );

  function isToken(obj: any): obj is Token {
    return typeof obj === 'object' && obj !== null &&
      'plainTextToken' in obj && typeof obj.plainTextToken === 'string';
  }

  function isUser(obj: any): obj is User {
    return typeof obj === 'object' && obj !== null &&
      'email' in obj && typeof obj.email === 'string';
  }

  function getUser(): User | null {
    let userRaw = localStorage.getItem('user') ?? null
    if (userRaw === null) return null
    const user = JSON.parse(userRaw)
    return isUser(user) ? user : null
  }

  function getToken(): Token | null {
    let tokenRaw = localStorage.getItem('token') ?? null
    if (tokenRaw === null) return null
    const token = JSON.parse(tokenRaw)
    return isToken(token) ? token : null
  }

  function setToken(tokenRaw: Token) {
    token.value = tokenRaw
    localStorage.setItem('token', JSON.stringify(token.value))
  }

  function setUser(userRaw: User) {
    user.value = userRaw
    localStorage.setItem('user', JSON.stringify(user.value))
  }

  async function whoami() {

    try {
      if (token === null) {
        throw new AuthError({ message: "Token not found.", status: 404 })
      }
      const response = await http.get('/auth/whoami', {
        headers: {
          Authorization: 'Bearer ' + token.value?.plainTextToken
        }
      })
      const responseData = response.data.user as User
      setUser(responseData)
      return responseData
    } catch (error: any) {
      if (error instanceof BaseError) {
        throw error
      }
      throw new AuthError({ message: "Error while authenticating the user token", status: 401 })
    }
  }

  async function verifyToken() {
    try {
      if (token === null) {
        throw new AuthError({ message: "Token not found.", status: 404 })
      }
      const response = await http.get('auth/verify', {
        headers: {
          Authorization: `Bearer ${token.value?.plainTextToken}`
        }
      })
      console.log(response)
      if (response.status != 200) return false
      return true
    } catch (error: any) {
      return false
    }
  }

  function logout(){
    localStorage.removeItem('user')
    localStorage.removeItem('token')
    user.value = null
    token.value = null
    isLoggedIn.perm = false
  }

  return {
    token,
    user,
    setToken,
    setUser,
    whoami,
    verifyToken,
    logout,
    isLoggedIn
  }
})