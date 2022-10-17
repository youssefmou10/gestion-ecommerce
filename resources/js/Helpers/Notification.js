import Noty from 'noty';
class Notification{
  success(){
      new Noty({
    type:'success',
    layout:'topRight',
    text: 'Succssefuly Done',
    timeout:1000,

}).show();

}
  alert(){
      new Noty({
    type:'alert',
    layout:'topRight',
    text: 'Are you sure?',
    timeout:1000,

}).show();

  }
  error(){
      new Noty({
    type:'error',
    layout:'topRight',
    text: 'Something went wrong ',
    timeout:1000,

}).show();

  }
   warning(){
      new Noty({
    type:'warning',
    layout:'topRight',
    text: 'Opss Wrong!',
    timeout:1000,

}).show();}
image_vaidation(){
  new Noty({
type:'error',
layout:'topRight',
text: 'Upload image Less tahn 1MB',
timeout:1000,

}).show();}

cart_success(){
  new Noty({
type:'success',
layout:'topRight',
text: 'add To carte Success',
timeout:1000,

}).show();}



}



export default  Notification = new Notification();