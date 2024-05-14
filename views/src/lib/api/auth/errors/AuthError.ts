import { BaseError, ErrorMessage } from "@/error/error";

export class AuthError extends BaseError {
  constructor(message: ErrorMessage){
    super(message)
    this.name = "Auth error"
  }
}
