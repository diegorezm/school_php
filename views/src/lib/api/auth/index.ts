import http from "@/config/axios/http";
import { Login, Token, TokenResponse, User } from "./interface";
import { defaultErrorHandler } from "@/config/axios/default-error-handler";
import { LoginError } from "./errors/LoginError";

const defaultUrl = "/auth"

type LoginResponse = { token: Token, user: User };
export async function login(data: Login): Promise<LoginResponse>
{
  try {
    let requestUrl = defaultUrl + "/login"
    const response = await http.post(requestUrl, data)
    console.log(response)
    const responseData = response.data.token as TokenResponse
    const token: Token = {
      plainTextToken: responseData.plainTextToken,
      expiresAt: responseData.accessToken.expires_at 
    }
    const user = response.data.user as User
    return { token, user }
  } catch (error:any) {
    throw new LoginError(defaultErrorHandler(error))
  }
}

export async function register(user: User): Promise<User>
{
  let requestUrl = defaultUrl + "/register"
  const response = await http.post(requestUrl, user);
  return response.data as User
}