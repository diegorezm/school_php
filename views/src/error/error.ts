export interface ErrorMessage{
  message: string;
  status: number;
}

export class BaseError extends Error {
  public status: number;
  constructor(message: ErrorMessage){
    super()
    this.message = message.message
    this.status = message.status
  }
}