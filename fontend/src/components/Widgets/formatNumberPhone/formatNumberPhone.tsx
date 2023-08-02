/* eslint-disable consistent-return */
export const formatNumberWithDot = (phone?: string) => {
  const myPhone = phone?.match(/(\d)/g)?.join('');
  if (myPhone === undefined) return '';
  if (myPhone?.length === 11) {
    return myPhone.replace(/(\d{2})(\d{3})(\d{3})(\d{3})/, '+$1 $2 $3 $4');
  }
  if (myPhone?.length === 12) {
    return myPhone.replace(/(\d{2})(\d{3})(\d{3})(\d{4})/, '+$1 $2 $3 $4');
  }
  if (myPhone?.length === 13) {
    return myPhone.replace(/(\d{2})(\d{3})(\d{4})(\d{4})/, '+$1 $2 $3 $4');
  }
  if (myPhone?.length === 14) {
    return myPhone.replace(/(\d{2})(\d{4})(\d{4})(\d{4})/, '+$1 $2 $3 $4');
  }

  return myPhone;
};
