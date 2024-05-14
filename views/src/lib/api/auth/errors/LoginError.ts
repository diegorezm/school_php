import { BaseError, ErrorMessage } from "@/error/error";

export class LoginError extends BaseError {
  constructor(message: ErrorMessage){
    super(message)
    this.name = "Login error"
  }
}
