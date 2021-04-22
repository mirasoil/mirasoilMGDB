1. Stripe (composer require stripe/stripe-php)
2. In orders, on delete, update - cascade !

3.Dupa implementare componenta vue cu language switcher, rutele care necesita parametru aditional nu mai functioneaza ! De verificat !
https://stackoverflow.com/questions/62607673/laravel-language-switcher-pass-additional-parameters-to-a-route 

4.Invoice review - only one product from array accessed, also revieworder.blade.php - ajax

5. In revieworder, when pressing on proceed to payment - I should first store the order in a session variable and only if payment completed => store it in the database

6. La modifica din orders - eventual sa apara o modala in care sa am un singur field de tip input cu slug (0 sau 1) si doar acela sa poata fi modificat fara a mai face o pagina separat pentru ca alte detalii nu trebuiesc modificate la nivel de comanda