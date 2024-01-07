import mitt from "mitt";


export const SHOW_NOTIFICATION = 'SHOW_NOTIFICATION'




 export const emitter = mitt();



 export function showSuccessNotification(message){
     emitter.emit(SHOW_NOTIFICATION, {type: 'success', message});
}
