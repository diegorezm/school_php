import { ErrorMessage } from "@/error/error";
import { AxiosError } from "axios";
type DefaultErrorHandler = (error: AxiosError) => ErrorMessage
export const defaultErrorHandler: DefaultErrorHandler =  (error: AxiosError) => {
  let defaultResponse: ErrorMessage = {
    message: "Internal server error.",
    status: error.status ?? 500
  }
  if(error.response){
    if (error.response.data && error.response.data.hasOwnProperty('message')) {
      defaultResponse.message = error.response.data.message
    }
  }
  return defaultResponse
}