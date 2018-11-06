import { Component } from '@angular/core';
import { NavController, ModalController, AlertController } from 'ionic-angular';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { RestInfoProvider } from '../../providers/rest-info/rest-info';

@Component({
  selector: 'page-home',
  templateUrl: 'home.html'
})
export class HomePage {

   //VARIABLES
   trabajadores:any = {};
   info:any;
   data :any;
   servicios:any;
   productos:any;
   promociones:any;
   ofer:any;
   //FORMULARIO 
   private FInfo : FormGroup;
 
   constructor(public navCtrl: NavController , private FBuild : FormBuilder , public alertCtrl:AlertController,
     private InfoService : RestInfoProvider , public modalCtrl : ModalController) {
     this.FInfo = this.FBuild.group({
       Descripcion:['',Validators.maxLength(300)],
       Precio:['',[Validators.required,Validators.pattern(/^[0-9]+$/),Validators.maxLength(7)]],
       estado:['A'],
       correo:['admin@admin.cl'],
       servicio:[],
       cod_servicio:[],
       fecha_public:[],//registrar fecha
       tipo_info:[]//validar solo un tipo
     })
     this.TreaerServicios()

   }

  //METODOS *************************************************************************************
   TreaerServicios(){ //TRAER SERVICIOS DE LA BASE DE DATOS PRA LISTARLOS EN EL EL INPUT SELECT
     this.InfoService.TraerServicios().subscribe((resp)=>{
        this.servicios = resp;
     },(error)=>(console.log(error)))
   }
   //PUBLICAR INFORMACION ************************************************************************
   PublicarInfo(Info){
      // FORMAR CADENA DE FECHA ACTUAL
      var f = new Date();
      var fecha = f.getDate();
      var mm = f.getMonth(); //January is 0!
      var yyyy = f.getFullYear();
     if(mm == 9){ 
      mm = mm +1;
     }
     if(fecha<10){
         var dia = '0'+fecha;
     }else{
       dia = ''+fecha; 
     }
     if(mm<10){
        var mes = '0' + mm; 
        var fecha_formt = yyyy +'/' + mes +'/'+ dia;
      }else{
        fecha_formt = yyyy +'/' + mm +'/'+ dia;
      }
      //ASIGNACION DE VALORES A CAMPO FECHA
      this.FInfo.controls['fecha_public'].setValue(fecha_formt);
      //ASIGNACION DE CODIGO DE SERVICIO SEGUN EL SELECT
        var nombre = this.FInfo.controls['servicio'].value
        if( nombre != 'Nada'){
          this.servicios.forEach(element => {
            if(element["nombre"] == nombre ){
              this.FInfo.controls['cod_servicio'].setValue(element['cod_servicio']);        
            }
          });
        }
      console.log(this.FInfo.value)
      this.InfoService.IngresarInformacion(Info.value).subscribe((response) =>{
        console.log(response)
      },
      (error)=>{console.log(error)})
   }
   //FIN AGREGAR***************************************************************************
   //LISTAR INFORMACIONES *****************************************************************
   ListarInformaciones(){
      this.InfoService.ListarInfos().subscribe((response)=>{
        this.info= response;
        console.log(response)
        let a = [];
        let b = [];
        let c= [];
        this.info.forEach(element => {
          if(element['tipo_info']=="Oferta"){
              a.push(element)
          }else if(element['tipo_info']=="Promocion"){
              b.push(element)
          }else{
              c.push(element)
          }
         this.ofer = a;
         this.productos=c;
         this.promociones=b;
        });
      })
   }
   OpenModal(){

   }
   //FIN LISTAR***************************************************************************
   //MODIFICAR INFORMACIONES**************************************************************
   Modificar(infos){


   }
   Eliminar(info){
      this.InfoService.EliminarInformacion(info).subscribe((response)=>{
        let mensaje:any = response;
        console.log(mensaje)
        //TODO ALERTA DE EXITO
      },(error)=>console.log(error))
   }
   



}
