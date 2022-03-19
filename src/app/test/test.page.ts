import { Component, OnInit } from '@angular/core';
import {
  AngularFireDatabase,
  AngularFireList,
} from '@angular/fire/compat/database';
import { AngularFirestore } from '@angular/fire/compat/firestore';
import { Observable } from 'rxjs';
import { DataService } from '../services/data.service';

@Component({
  selector: 'app-test',
  templateUrl: './test.page.html',
  styleUrls: ['./test.page.scss'],
})
export class TestPage implements OnInit {
  public categoriesName;

  constructor(
    private readonly afDatabase: AngularFireDatabase,
    private firestore: AngularFirestore,
    private dataService: DataService
  ) {}

  ngOnInit() {
    this.dataService.getCategories().subscribe((response: any) => {
      this.categoriesName = Object.keys(response[0]);
      console.log('BDD', Object.keys(response[0].laitages));
    });

    // permet d'avoir la liste des laitages
    this.dataService.getCategories().subscribe((response: any) => {
      console.log('Liste des laitages', Object.keys(response[0].laitages));
    });

    // permet d'avoir la liste des féculents
    this.dataService.getCategories().subscribe((response: any) => {
      console.log('Liste des féculents', Object.keys(response[0].féculents));
    });

    // permet d'avoir la liste des viandes
    this.dataService.getCategories().subscribe((response: any) => {
      console.log('Liste des viandes', Object.keys(response[0].viandes));
    });

    // permet d'avoir les caracteristiques des abats
    this.dataService.getCategories().subscribe((response: any) => {
      console.log('Caracteristiques des abats', response[0].viandes.abats);
    });

    // permet d'avoir les caracteristiques des légumes racine
    this.dataService.getCategories().subscribe((response: any) => {
      console.log(
        'Caracteristiques des légumes racine',
        response[0].féculents['légumes racine']
      );
    });
  }
}
