import { NgModule } from '@angular/core';
import { PreloadAllModules, RouterModule, Routes } from '@angular/router';

const routes: Routes = [
  {
    path: '',
    loadChildren: () => import('./sidenav/sidenav.module').then( m => m.SidenavPageModule)
  },
  {
    path: 'feculent',
    loadChildren: () => import('./feculent/feculent.module').then( m => m.FeculentPageModule)
  },
  {
    path: 'laitages',
    loadChildren: () => import('./laitages/laitages.module').then( m => m.LaitagesPageModule)
  },
  {
    path: 'legumes',
    loadChildren: () => import('./legumes/legumes.module').then( m => m.LegumesPageModule)
  },
  {
    path: 'viandes',
    loadChildren: () => import('./viandes/viandes.module').then( m => m.ViandesPageModule)
  },
];

@NgModule({
  imports: [
    RouterModule.forRoot(routes, { preloadingStrategy: PreloadAllModules })
  ],
  exports: [RouterModule]
})
export class AppRoutingModule { }
