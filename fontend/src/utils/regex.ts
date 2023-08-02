/* eslint-disable prettier/prettier */
/* eslint-disable no-useless-escape */
export const regexPhone = /^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$/;
export const regexNumber = /^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$/;
export const regexPhoneNumber =
  /^\+?(8419\d{6}|[87](?!95[5-7]|99[08]|907|94[^09]|336)([348]\d|9[0-6789]|7[01247])\d{8}|[1246]\d{9,13}|68\d{7}|5[1-46-9]\d{8,12}|55[1-9]\d{9}|55[138]\d{10}|55[1256][14679]9\d{8}|554399\d{7}|500[56]\d{4}|5016\d{6}|5068\d{7}|502[345]\d{7}|5037\d{7}|50[4567]\d{8}|50855\d{4}|509[34]\d{7}|376\d{6}|855\d{8,9}|856\d{10}|85[0-4789]\d{8,10}|8[68]\d{10,11}|8[14]\d{10}|82\d{9,10}|852\d{8}|90\d{10}|96(0[79]|17[0189]|181|13)\d{6}|96[23]\d{9}|964\d{10}|96(5[569]|89)\d{7}|96(65|77)\d{8}|92[023]\d{9}|91[1879]\d{9}|9[34]7\d{8}|959\d{7,9}|989\d{9}|971\d{8,9}|97[02-9]\d{7,11}|99[^4568]\d{7,11}|994\d{9}|9955\d{8}|996[2579]\d{8}|998[3789]\d{8}|380[345679]\d{8}|381\d{9}|38[57]\d{8,9}|375[234]\d{8}|372\d{7,8}|37[0-4]\d{8}|37[6-9]\d{7,11}|30[69]\d{9}|34[679]\d{8}|3459\d{11}|3[12359]\d{8,12}|36\d{9}|38[169]\d{8}|382\d{8,9}|46719\d{10})$/;
export const regexEmail = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
export const regexPwdStrong = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,15}$/;
export const regexUrl = /(^http[s]?:\/{2})|(^www)|(^\/{1,2})/;
export const regexSlug = /^[a-z0-9]+(?:-[a-z0-9]+)*$/;
export const regexUsername = /^[a-zA-Z0-9_.]{3,30}$/;
export const regexAlphabet = /^[a-zA-Z]*$/;
export const regexAZUppercase = /^[A-Z]*$/;

export const regexImage = /\.(jpg|jpeg|png|gif|JPG|JPEG|PNG|GIF)$/;
export const regexVideo = /\.(mp4|mov|mwv|avi|mkv|flv|webm|mts|mpeg4|MP4|MOV|WMV|AVI|MKV|FLV|WEBM|MTS|MPEG4)$/;
export const regexAudio = /\.(mp3|flac|wav|wma|aac|m4A|M4A|FLAC|MP3|WAV|WMA|AAC)$/;
export const regexDocument = /\.(csv|pdf|doc|docx|xls|xlsx|ppt|pptx|txt|xml|odt|ods|CSV|PDF|DOC|DOCX|XLS|XLSX|PPT|PPTX|TXT|XML|ODT|ODS)$/;
