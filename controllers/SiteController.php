<?php

namespace app\controllers;

use app\models\Camposextra;
use app\models\CamposextraForm;
use app\models\CamposextraNoCompraForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Cliente;
use app\models\ClienteForm;
use app\models\ConfirmarForm;
use Symfony\Component\BrowserKit\Client;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionCliente()
    {
        $model = new ClienteForm();
        $msg = isset($_REQUEST[1]['msg']) ? $_REQUEST[1]['msg'] : '';
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $table = new Cliente;
                $table->nombre = $model->nombre;
                $table->cedula = $model->cedula;
                $table->telefono = $model->telefono;
                $table->email = $model->email;
                $table->genero = $model->genero;
                //Consulto si ya existe un cliente con ese mismo numero de cedula
                $existeCliente = Cliente::find()->where(['cedula' => $model->cedula])->one();
                if(!$existeCliente){
                    if ($table->insert())
                        return $this->redirect(['confirmar', 'clienteId' => $table->id]);
                    else
                        $msg = "Ha ocurrido un error al insertar el registro";
                }

                $msg = "El cliente ya esta registrado";
                
            } else {
                $model->getErrors();
            }
        }
        return $this->render("cliente", ['model' => $model, 'msg' => $msg]);
    }

    public function actionConfirmar()
    {
        $model = new ConfirmarForm;
        //Tomo el id del cliente que viene en el request 
        $cliente_id = isset($_REQUEST['clienteId']) ? $_REQUEST['clienteId'] : null;
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate())
                return $this->redirect(['comprar', 'clienteId' =>  $cliente_id, 'comprar' => $model->comprar]);
            else
                $model->getErrors();
        }
        return $this->render("confirmar", ['model' => $model, 'clienteId' =>  $cliente_id]);
    }

    public function actionComprar()
    {
        //Tomo el valor booleano para saber si compra o no, que viene en el request 
        $comprar =  isset($_REQUEST['comprar']) ?  $_REQUEST['comprar'] : null;
        //De pendiendo de si compra o no, cambio de formulario para hacer las validaciones de los campos
        $model = $comprar ? new CamposextraForm : new CamposextraNoCompraForm;

        //Tomo el id del cliente que viene en el request 
        $cliente_id = isset($_REQUEST['clienteId']) ? $_REQUEST['clienteId'] : null;
        
        if ($model->load(Yii::$app->request->post())) {

            if ($model->validate()) {
                $table = new Camposextra;
                $table->id_externo = $cliente_id;
                // Instancio el formulario de cliente para redirecionar a la ruta cliente
                $clienteForm =  new ClienteForm;

                if ($comprar) {
                    $table->articulo = $model->articulo;
                    $table->precio = $model->precio;
                    $table->medio_pago = $model->medio_pago;
                } else {
                    $table->negatividad = $model->negatividad;
                }
                // Si se ingresa correctamente el registro mando un mensaje al igual 
                // que si no se ingresa correctamente
                $msg = $table->insert() ? "Se registraron los datos correctamente" : "Ha ocurrido un error al insertar el registro";

                return $this->redirect(['cliente', ['model' => $clienteForm, 'msg' => $msg]]);
            } else {
                $model->getErrors();
            }
        }
        return $this->render("comprar", ['model' => $model, 'clienteId' => $cliente_id, 'comprar' => $comprar]);
    }
}
