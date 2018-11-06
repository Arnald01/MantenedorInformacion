import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

/*
  Generated class for the RestInfoProvider provider.

  See https://angular.io/guide/dependency-injection for more info on providers
  and Angular DI.
*/
@Injectable()
export class RestInfoProvider {

  api : string = 'http://localhost/php/Informaciones/'

  constructor(public http: HttpClient) {
    console.log('Hello RestInfoProvider Provider');
  }

  TraerServicios(){//TRAER SERVICIOS PARA LISTARLOS
   return this.http.get(this.api+'TraerServicios.php');
  }
  IngresarInformacion(datos){//INSERTAR INFORMACIONES
    return this.http.post(this.api+'InsertarInfo.php',JSON.stringify(datos))
  }
  ListarInfos(){
    return this.http.get(this.api+'ListarInfo.php')
  }
  EliminarInformacion(datos){//INSERTAR INFORMACIONES
    return this.http.post(this.api+'EliminarInfo.php',JSON.stringify(datos))
  }
}
