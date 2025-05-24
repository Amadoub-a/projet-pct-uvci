<?php

namespace App\Http\Controllers;

use Exception;
use CinetPay\CinetPay;
use Illuminate\Http\Request;

class CinetPayController extends Controller
{
    public function NotifyUrl(Request $request)
    {
        if (isset($_POST['cpm_trans_id'])) {
            try {
                // Récupérer les informations de configuration
                $apikey = config('cinetpay.apikey');
                $site_id = $_POST['cpm_site_id']; // Site ID reçu dans le POST

                // Initialiser la classe CinetPay avec les données
                $CinetPay = new CinetPay($site_id, $apikey);

                // Appeler la méthode pour obtenir le statut de la transaction
                $CinetPay->getPayStatus(); // Cette méthode remplit les propriétés internes

                // Accéder aux informations de la transaction via les propriétés publiques
                $amount = $CinetPay->_cpm_amount;  // Montant de la transaction
                $currency = $CinetPay->_cpm_currency;  // Devise
                $message = $CinetPay->_cpm_error_message;  // Message d'erreur
                $code = $CinetPay->_cpm_result;  // Résultat de la transaction (par exemple "00" pour succès)
                $metadata = $CinetPay->_cpm_custom;  // Métadonnées personnalisées si disponibles

                // Enregistrer les logs
                $log  = "User: " . $_SERVER['REMOTE_ADDR'] . ' - ' . date("F j, Y, g:i a") . PHP_EOL .
                        "Code:" . $code . PHP_EOL .
                        "Message: " . $message . PHP_EOL .
                        "Amount: " . $amount . PHP_EOL .
                        "Currency: " . $currency . PHP_EOL .
                        "-------------------------" . PHP_EOL;
                file_put_contents(storage_path('logs/log_' . date("j.n.Y") . '.log'), $log, FILE_APPEND);

                // Vérifier le statut de la transaction
                if ($code == '00') {
                    // Transaction réussie
                    echo 'Félicitations, votre paiement a été effectué avec succès';
                    die();
                } else {
                    // Transaction échouée
                    echo 'Echec, votre paiement a échoué pour la raison : ' . $message;
                    die();
                }
            } catch (Exception $e) {
                echo "Erreur :" . $e->getMessage();
            }
        } else {
            // Si `cpm_trans_id` n'est pas présent
            echo "cpm_trans_id non fourni";
        }
    }
}
