export interface User {
  id?: number;
  name: string;
  email: string;
  created_at: Date;
  updated_at: Date;
}

export type Login = {
  email: string,
  password: string
}

export type TokenResponse = {
  accessToken: {
    name: string;
    abilities: string[];
    expires_at: Date;
    tokenable_id: number;
    tokenable_type: string;
    updated_at: Date;
    created_at: Date;
    id: number;
  };
  plainTextToken: string;
}

export type Token = {
  plainTextToken: string;
  expiresAt: Date;
}