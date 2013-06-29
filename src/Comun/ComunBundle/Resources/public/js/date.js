
$('[data-jquery="date"]').datepicker({
    numberOfMonths: 1,dateFormat: 'dd/mm/yy',
    monthNames: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],
    dayNamesShort: ["Dom", "Lun", "Mar", "Mir", "Jue", "Vin", "Sab"],
    "dayNamesMin":["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
    dayNames: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
    "closeText": "Listo",
    changeYear: true
});


$('[data-jquery="datetime"]').datetimepicker({
    numberOfMonths: 1,dateFormat: 'dd/mm/yy',
    monthNames: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],
    dayNamesShort: ["Dom", "Lun", "Mar", "Mir", "Jue", "Vin", "Sab"],
    "dayNamesMin":["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
    dayNames: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
    "closeText": "Listo",
    currentText: "Ahora",
    timeOnlyTitle:'Tiempo',
    timeText:'Tiempo',
    hourText:'Hora',
    minuteText:'Minuto',
    changeYear: true
});