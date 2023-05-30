import { TUser } from './user';

export type TSignIn = {
  email: string,
  password: string,
};

export type TSignature = {
  access_token: string,
  expires_at: number,
  refresh_token: string,
  expiredAtRefreshToken: number,
  email: string,
  phone: string,
};

export type TAuth = {
  user: TUser,
  auth: TSignature,
};
export type TChangePassword = {
      newPassword: string;
      confirmPassword: string;
      oldPassword: string;
};
export type TPassword = Omit<TChangePassword, 'oldPassword'>;
export type TRegister = {
      name: string;
      phone: number;
      birth: Date;
      sex: string;
      password: string;
      favoriteMovie: string;
} & TPassword;