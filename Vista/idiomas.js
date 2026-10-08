// ---------- Textos ----------
const TEXTOS = {
  es: {
    "pagina.estadisticas": "Estadísticas - Epsilon",
    "pagina.gestion": "Gestión - Epsilon",
    "pagina.documentacion": "Documentación - Epsilon",

    "menu.gestion": "Gestión",
    "menu.panelRutas": "Panel Rutas",
    "menu.misIncidencias": "Mis Incidencias",
    "menu.panelOperario": "Panel Operario",
    "menu.mapa": "Mapa",
    "menu.estadisticas": "Estadísticas",
    "menu.documentacion": "Documentación",

    "usuario.cerrarSesion": "Cerrar Sesión",
    "usuario.porDefecto": "Usuario",

    "comun.sinAsignar": "Sin asignar",
    "comun.conexion": "Error de conexión.",

    "status.ok": "Operación realizada con éxito.",
    "status.creado": "Creado correctamente.",
    "status.datos_invalidos": "Datos inválidos. Revisá los campos.",
    "status.error": "Ocurrió un error. Intentá de nuevo.",
    "status.no_encontrado": "No se encontró lo solicitado.",
    "status.no_autorizado": "Tenés que iniciar sesión.",
    "status.no_permitido": "Acción no permitida.",
    "status.prohibido": "No tenés permiso para realizar esta acción.",
    "status.no_disponible": "El recurso no está disponible.",
    "status.sin_camion": "La cuadrilla no tiene un camión asignado.",
    "status.cuenta_pendiente": "Tu cuenta está pendiente de aprobación.",

    "estado.Vacio": "Vacío",
    "estado.Media capacidad": "Media capacidad",
    "estado.Lleno": "Lleno",
    "estado.Desbordado": "Desbordado",
    "estado.roto": "Roto",
    "estado.Disponible": "Disponible",
    "estado.En Servicio": "En servicio",
    "estado.Mantenimiento": "Mantenimiento",
    "estado.Averiado": "Averiado",
    "estado.Pendiente": "Pendiente",
    "estado.Terminada": "Terminada",
    "estado.En Curso": "En curso",
    "estado.Finalizada": "Finalizada",
    "estado.Activo": "Activo",
    "estado.Inactivo": "Inactivo",
    "estado.Activa": "Activa",
    "estado.Inactiva": "Inactiva",

    "tipoIncidencia.rotura": "Contenedor dañado",
    "tipoIncidencia.lleno": "Contenedor lleno",
    "tipoIncidencia.desbordado": "Contenedor desbordado",
    "tipoIncidencia.incendiado": "Contenedor incendiado",

    "tipoContenedor.Naranja": "Naranja - Reciclables",
    "tipoContenedor.Metalico": "Metálico - Residuos mezclados",
    "tipoContenedor.Plastico": "Plástico - Residuos mezclados",

    "rol.Vecino": "Vecino",
    "rol.Recolector": "Recolector",
    "rol.Operario": "Operario",
    "rol.Administrador": "Administrador",

    "est.titulo": "Panel de Control",
    "est.subtitulo": "Resumen general del sistema.",
    "est.actualizado": "Actualizado:",
    "est.contenedores": "Contenedores totales",
    "est.incidencias": "Incidencias pendientes",
    "est.centros": "Centros de acopio",
    "est.camiones": "Camiones disponibles",
    "est.rutas": "Rutas en curso",
    "est.cuadrillas": "Cuadrillas activas",
    "est.eficiencia": "Eficiencia",
    "est.eficienciaDesc":
      "Porcentaje de contenedores sin saturar (vacíos o a media capacidad).",
    "est.reporte": "Generar reporte",
    "est.exportar": "Exportar datos",
    "est.informe": "Exportar historial de incidencias",
    "est.actualizar": "Actualizar métricas",
    "est.sinIncidencias": "No hay incidencias para exportar.",
    "est.errorIncidencias": "No se pudo obtener el historial de incidencias.",

    "csv.metrica": "Métrica",
    "csv.valor": "Valor",
    "csv.contenedores": "Contenedores",

    "inc.id": "ID",
    "inc.fecha": "Fecha de creación",
    "inc.tipo": "Tipo",
    "inc.estado": "Estado",
    "inc.mail": "Mail",
    "inc.calle": "Calle",
    "inc.numero": "Número",
    "inc.barrio": "Barrio",
    "inc.tipoContenedor": "Tipo de contenedor",
    "inc.operario": "Operario (ID)",
    "inc.cuadrilla": "Cuadrilla",

    "gestion.eyebrow": "Administración",
    "gestion.titulo": "Gestión de Residuos",
    "gestion.bienvenida":
      "Bienvenido/a, {nombre}. Elegí un módulo para empezar.",
    "gestion.modulos": "Módulos activos",
    "gestion.monitoreo": "Monitoreo continuo",
    "gestion.registro": "Registro",
    "gestion.registroDesc":
      "Alta general de operaciones y movimientos del sistema.",
    "gestion.contenedores": "Contenedores",
    "gestion.contenedoresDesc":
      "Ubicación, tipo y estado de cada contenedor de la ciudad.",
    "gestion.camiones": "Camiones",
    "gestion.camionesDesc":
      "Flota disponible y asignación de camiones recolectores.",
    "gestion.usuarios": "Usuarios",
    "gestion.usuariosDesc": "Cuentas, roles y permisos del personal.",
    "gestion.centros": "Centros de Acopio",
    "gestion.centrosDesc":
      "Puntos de acopio, capacidad y estado de cada centro.",
    "gestion.rutas": "Rutas",
    "gestion.rutasDesc": "Trazado y ajuste de las rutas de recolección.",
    "gestion.cuadrillas": "Cuadrillas",
    "gestion.cuadrillasDesc":
      "Formación y gestión de cuadrillas de recolectores.",
    "gestion.incidencias": "Incidencias",
    "gestion.incidenciasDesc":
      "Reportes de la ciudadanía pendientes de resolución.",

    "pagina.login": "Login - Epsilon",
    "pagina.registro": "Registro - Epsilon",

    "comun.cancelar": "Cancelar",

    "auth.mail": "Mail",
    "auth.contrasenia": "Contraseña",
    "auth.ingresar": "Ingresar",
    "auth.olvidaste": "¿Olvidaste tu contraseña?",
    "auth.crearCuenta": "Crear Cuenta",
    "auth.nombre": "Nombre",
    "auth.apellido": "Apellido",
    "auth.correo": "Correo Electrónico",
    "auth.usuario": "Usuario",
    "auth.confirmar": "Confirmar Contraseña",
    "auth.registrarse": "Registrarse",
    "auth.yaTengoCuenta": "Ya tengo una cuenta",

    "index.registrar": "Registrar",
    "index.iniciarSesion": "Iniciar Sesión",

    "notif.titulo": "Notificaciones",
    "notif.marcarLeidas": "Marcar todas como leídas",
    "notif.vacio": "No tenés notificaciones.",

    "form.reportar": "Reportar incidencia",
    "form.crearTitulo": "Crear Incidencia",
    "form.tipo": "Tipo",
    "form.seleccioneTipo": "Seleccione un tipo",
    "form.imagen": "Imagen",
    "form.contenedor": "Contenedor:",
    "form.buscar": "Buscar por calle, número o barrio",
    "form.direccionNueva": "¿No está en la lista? Ingresar dirección nueva",
    "form.volverLista": "Volver a la lista de contenedores",
    "form.calle": "Calle",
    "form.numero": "Número",
    "form.barrio": "Barrio",
    "form.tipoContenedor": "Tipo de contenedor:",
    "form.naranja": "Reciclables",
    "form.cargando": "Cargando contenedores...",
    "form.sinContenedores": "No hay contenedores disponibles.",
    "form.errorContenedores": "Error al cargar los contenedores.",
    "form.noEncontrados": "No se encontraron contenedores.",
    "form.errorRegistrar": "No se pudo registrar la incidencia.",
    "form.soloImagenes":
      "Solo se permiten imágenes en formato JPG, JPEG o PNG.",
    "form.necesitasLogin":
      "Necesitás iniciar sesión para reportar una incidencia.",

    "hero.overline": "Plataforma de gestión ambiental urbana",
    "hero.titulo1": "Transformando la",
    "hero.titulo2": "gestión urbana",
    "hero.titulo3": "de residuos en algo más simple y sostenible",
    "hero.texto":
      "Monitoreo, recolección y optimización de rutas en tiempo real, para una ciudad más limpia y eficiente.",
    "hero.explorarMapa": "Explorar Mapa",

    "dato.contenedores": "+1.200",
    "dato.contenedoresDesc": "Contenedores monitoreados",
    "dato.tiposDesc": "Tipos de residuo clasificados",
    "dato.seguimientoDesc": "Seguimiento en tiempo real",
    "dato.min": "Min.",
    "dato.rutasDesc": "Rutas optimizadas por incidencia",

    "como.titulo": "Cómo funciona Epsilon",
    "como.subtitulo":
      "Un ciclo simple que conecta a la ciudadanía con la recolección y la optimización de rutas.",
    "como.reportar": "Reportar",
    "como.reportarDesc":
      "Cualquier vecino notifica el estado de un contenedor: lleno, dañado o desbordado, con foto y ubicación exacta.",
    "como.recolectar": "Recolectar",
    "como.recolectarDesc":
      "Los camiones reciben rutas ajustadas según las incidencias activas y el estado real de cada zona.",
    "como.optimizar": "Optimizar",
    "como.optimizarDesc":
      "El sistema analiza los datos acumulados para mejorar frecuencias, recorridos y ubicación de contenedores.",

    "serv.titulo": "Explorá la plataforma",
    "serv.subtitulo":
      "Todo lo que necesitás para seguir la gestión de residuos de la ciudad.",
    "serv.mapaDesc":
      "Ubicación en vivo de contenedores, camiones e incidencias.",
    "serv.estadisticasDesc":
      "Indicadores de recolección, incidencias y desempeño por zona.",
    "serv.documentacionDesc":
      "Guías del sistema, tipos de residuo y buenas prácticas de uso.",

    "pie.tagline": "Gestión integral de residuos urbanos, en tiempo real.",
    "pie.plataforma": "Plataforma",
    "pie.cuenta": "Cuenta",
    "pie.iniciar": "Iniciar sesión",
    "pie.copy": "© 2026 Epsilon. Todos los derechos reservados.",

    "doc.titulo": "Documentación",
    "doc.subtitulo": "Manuales e información del sistema.",
    "doc.manual": "Manual de Usuario",
    "doc.guias": "Guías",
    "doc.faq": "Preguntas Frecuentes",

    "pagina.login": "Login - Epsilon",
    "pagina.registro": "Registro - Epsilon",
    "pagina.index": "Epsilon",

    "comun.cancelar": "Cancelar",

    "login.mail": "Mail",
    "login.contrasenia": "Contraseña",
    "login.ingresar": "Ingresar",
    "login.olvido": "¿Olvidaste tu contraseña?",
    "login.crearCuenta": "Crear Cuenta",

    "registro.nombre": "Nombre",
    "registro.apellido": "Apellido",
    "registro.mail": "Correo Electrónico",
    "registro.usuario": "Usuario",
    "registro.contrasenia": "Contraseña",
    "registro.confirmar": "Confirmar Contraseña",
    "registro.registrarse": "Registrarse",
    "registro.yaTengo": "Ya tengo una cuenta",

    "index.subtitulo": "Recolección y Gestión Integral de Residuos",
    "index.registrar": "Registrar",
    "index.iniciarSesion": "Iniciar Sesión",
    "index.notificaciones": "Notificaciones",
    "index.marcarLeidas": "Marcar todas como leídas",
    "index.sinNotificaciones": "No tenés notificaciones.",
    "notificacion.incidencia_asignada":
      "Tu incidencia #{id} fue asignada a una cuadrilla.",
    "notificacion.incidencia_resuelta": "Tu incidencia #{id} fue resuelta.",
    "index.reportar": "Reportar incidencia",
    "index.crearIncidencia": "Crear Incidencia",
    "index.tipo": "Tipo",
    "index.seleccioneTipo": "Seleccione un tipo",
    "index.imagen": "Imagen",
    "index.contenedor": "Contenedor:",
    "index.buscar": "Buscar por calle, número o barrio",
    "index.direccionNueva": "¿No está en la lista? Ingresar dirección nueva",
    "index.volverLista": "Volver a la lista de contenedores",
    "index.calle": "Calle",
    "index.numero": "Número",
    "index.barrio": "Barrio",
    "index.tipoContenedor": "Tipo de contenedor:",
    "index.cargandoContenedores": "Cargando contenedores...",
    "index.sinContenedores": "No hay contenedores disponibles.",
    "index.contenedoresNoEncontrados": "No se encontraron contenedores.",
    "index.errorContenedores": "Error al cargar los contenedores.",
    "index.necesitaLogin":
      "Necesitás iniciar sesión para reportar una incidencia.",
    "index.errorImagen":
      "Solo se permiten imágenes en formato JPG, JPEG o PNG.",
    "index.errorRegistrar": "No se pudo registrar la incidencia.",
    "index.overline": "Plataforma de gestión ambiental urbana",
    "index.titulo":
      "Transformando la <span class='acento'>gestión urbana</span> de residuos en algo más simple y sostenible",
    "index.descripcion":
      "Monitoreo, recolección y optimización de rutas en tiempo real, para una ciudad más limpia y eficiente.",
    "index.explorarMapa": "Explorar Mapa",
    "index.datoContenedores": "Contenedores monitoreados",
    "index.datoResiduos": "Tipos de residuo clasificados",
    "index.datoSeguimiento": "Seguimiento en tiempo real",
    "index.datoMin": "Min.",
    "index.datoRutas": "Rutas optimizadas por incidencia",
    "index.comoFunciona": "Cómo funciona Epsilon",
    "index.comoDesc":
      "Un ciclo simple que conecta a la ciudadanía con la recolección y la optimización de rutas.",
    "index.paso1": "Reportar",
    "index.paso1Desc":
      "Cualquier vecino notifica el estado de un contenedor: lleno, dañado o desbordado, con foto y ubicación exacta.",
    "index.paso2": "Recolectar",
    "index.paso2Desc":
      "Los camiones reciben rutas ajustadas según las incidencias activas y el estado real de cada zona.",
    "index.paso3": "Optimizar",
    "index.paso3Desc":
      "El sistema analiza los datos acumulados para mejorar frecuencias, recorridos y ubicación de contenedores.",
    "index.explora": "Explorá la plataforma",
    "index.exploraDesc":
      "Todo lo que necesitás para seguir la gestión de residuos de la ciudad.",
    "index.servicioMapa":
      "Ubicación en vivo de contenedores, camiones e incidencias.",
    "index.servicioEstadisticas":
      "Indicadores de recolección, incidencias y desempeño por zona.",
    "index.servicioDocumentacion":
      "Guías del sistema, tipos de residuo y buenas prácticas de uso.",

    "pie.descripcion": "Gestión integral de residuos urbanos, en tiempo real.",
    "pie.plataforma": "Plataforma",
    "pie.cuenta": "Cuenta",
    "pie.registrarse": "Registrarse",
    "pie.iniciar": "Iniciar sesión",
    "pie.copy": "© 2026 Epsilon. Todos los derechos reservados.",
  },

  en: {
    "pagina.estadisticas": "Statistics - Epsilon",
    "pagina.gestion": "Management - Epsilon",
    "pagina.documentacion": "Documentation - Epsilon",

    "menu.gestion": "Management",
    "menu.panelRutas": "Routes Panel",
    "menu.misIncidencias": "My Incidents",
    "menu.panelOperario": "Operator Panel",
    "menu.mapa": "Map",
    "menu.estadisticas": "Statistics",
    "menu.documentacion": "Documentation",

    "usuario.cerrarSesion": "Log out",
    "usuario.porDefecto": "User",

    "comun.sinAsignar": "Unassigned",
    "comun.conexion": "Connection error.",

    "status.ok": "Operation completed successfully.",
    "status.creado": "Created successfully.",
    "status.datos_invalidos": "Invalid data. Please check the fields.",
    "status.error": "Something went wrong. Please try again.",
    "status.no_encontrado": "The requested item was not found.",
    "status.no_autorizado": "You need to log in.",
    "status.no_permitido": "Action not allowed.",
    "status.prohibido": "You don't have permission to do this.",
    "status.no_disponible": "The resource is not available.",
    "status.sin_camion": "The crew has no truck assigned.",
    "status.cuenta_pendiente": "Your account is pending approval.",

    "estado.Vacio": "Empty",
    "estado.Media capacidad": "Half full",
    "estado.Lleno": "Full",
    "estado.Desbordado": "Overflowing",
    "estado.roto": "Broken",
    "estado.Disponible": "Available",
    "estado.En Servicio": "In service",
    "estado.Mantenimiento": "Maintenance",
    "estado.Averiado": "Out of order",
    "estado.Pendiente": "Pending",
    "estado.Terminada": "Completed",
    "estado.En Curso": "In progress",
    "estado.Finalizada": "Finished",
    "estado.Activo": "Active",
    "estado.Inactivo": "Inactive",
    "estado.Activa": "Active",
    "estado.Inactiva": "Inactive",

    "tipoIncidencia.rotura": "Damaged container",
    "tipoIncidencia.lleno": "Full container",
    "tipoIncidencia.desbordado": "Overflowing container",
    "tipoIncidencia.incendiado": "Container on fire",

    "tipoContenedor.Naranja": "Orange - Recyclables",
    "tipoContenedor.Metalico": "Metal - Mixed waste",
    "tipoContenedor.Plastico": "Plastic - Mixed waste",

    "rol.Vecino": "Resident",
    "rol.Recolector": "Collector",
    "rol.Operario": "Operator",
    "rol.Administrador": "Administrator",

    "est.titulo": "Control Panel",
    "est.subtitulo": "General system overview.",
    "est.actualizado": "Updated:",
    "est.contenedores": "Total containers",
    "est.incidencias": "Pending incidents",
    "est.centros": "Collection centers",
    "est.camiones": "Available trucks",
    "est.rutas": "Routes in progress",
    "est.cuadrillas": "Active crews",
    "est.eficiencia": "Efficiency",
    "est.eficienciaDesc":
      "Percentage of containers that are not saturated (empty or half full).",
    "est.reporte": "Generate report",
    "est.exportar": "Export data",
    "est.informe": "Export incident history",
    "est.actualizar": "Update metrics",
    "est.sinIncidencias": "There are no incidents to export.",
    "est.errorIncidencias": "The incident history could not be retrieved.",

    "csv.metrica": "Metric",
    "csv.valor": "Value",
    "csv.contenedores": "Containers",

    "inc.id": "ID",
    "inc.fecha": "Creation date",
    "inc.tipo": "Type",
    "inc.estado": "Status",
    "inc.mail": "Email",
    "inc.calle": "Street",
    "inc.numero": "Number",
    "inc.barrio": "Neighborhood",
    "inc.tipoContenedor": "Container type",
    "inc.operario": "Operator (ID)",
    "inc.cuadrilla": "Crew",

    "gestion.eyebrow": "Administration",
    "gestion.titulo": "Waste Management",
    "gestion.bienvenida": "Welcome, {nombre}. Pick a module to get started.",
    "gestion.modulos": "Active modules",
    "gestion.monitoreo": "Continuous monitoring",
    "gestion.registro": "Registry",
    "gestion.registroDesc":
      "General record of system operations and movements.",
    "gestion.contenedores": "Containers",
    "gestion.contenedoresDesc":
      "Location, type and status of every container in the city.",
    "gestion.camiones": "Trucks",
    "gestion.camionesDesc":
      "Available fleet and assignment of collection trucks.",
    "gestion.usuarios": "Users",
    "gestion.usuariosDesc": "Staff accounts, roles and permissions.",
    "gestion.centros": "Collection Centers",
    "gestion.centrosDesc":
      "Collection points, capacity and status of each center.",
    "gestion.rutas": "Routes",
    "gestion.rutasDesc": "Layout and adjustment of collection routes.",
    "gestion.cuadrillas": "Crews",
    "gestion.cuadrillasDesc": "Setup and management of collector crews.",
    "gestion.incidencias": "Incidents",
    "gestion.incidenciasDesc": "Citizen reports awaiting resolution.",

    "pagina.login": "Log in - Epsilon",
    "pagina.registro": "Sign up - Epsilon",

    "comun.cancelar": "Cancel",

    "auth.mail": "Email",
    "auth.contrasenia": "Password",
    "auth.ingresar": "Log in",
    "auth.olvidaste": "Forgot your password?",
    "auth.crearCuenta": "Create account",
    "auth.nombre": "First name",
    "auth.apellido": "Last name",
    "auth.correo": "Email address",
    "auth.usuario": "Username",
    "auth.confirmar": "Confirm password",
    "auth.registrarse": "Sign up",
    "auth.yaTengoCuenta": "I already have an account",

    "index.registrar": "Sign up",
    "index.iniciarSesion": "Log in",

    "notif.titulo": "Notifications",
    "notif.marcarLeidas": "Mark all as read",
    "notif.vacio": "You have no notifications.",

    "form.reportar": "Report an incident",
    "form.crearTitulo": "Create Incident",
    "form.tipo": "Type",
    "form.seleccioneTipo": "Select a type",
    "form.imagen": "Image",
    "form.contenedor": "Container:",
    "form.buscar": "Search by street, number or neighborhood",
    "form.direccionNueva": "Not in the list? Enter a new address",
    "form.volverLista": "Back to the container list",
    "form.calle": "Street",
    "form.numero": "Number",
    "form.barrio": "Neighborhood",
    "form.tipoContenedor": "Container type:",
    "form.naranja": "Recyclables",
    "form.cargando": "Loading containers...",
    "form.sinContenedores": "There are no containers available.",
    "form.errorContenedores": "Error loading the containers.",
    "form.noEncontrados": "No containers found.",
    "form.errorRegistrar": "The incident could not be registered.",
    "form.soloImagenes": "Only JPG, JPEG or PNG images are allowed.",
    "form.necesitasLogin": "You need to log in to report an incident.",

    "hero.overline": "Urban environmental management platform",
    "hero.titulo1": "Turning",
    "hero.titulo2": "urban waste management",
    "hero.titulo3": "into something simpler and more sustainable",
    "hero.texto":
      "Real-time monitoring, collection and route optimization for a cleaner, more efficient city.",
    "hero.explorarMapa": "Explore Map",

    "dato.contenedores": "+1,200",
    "dato.contenedoresDesc": "Containers monitored",
    "dato.tiposDesc": "Waste types classified",
    "dato.seguimientoDesc": "Real-time tracking",
    "dato.min": "Min.",
    "dato.rutasDesc": "Routes optimized per incident",

    "como.titulo": "How Epsilon works",
    "como.subtitulo":
      "A simple cycle that connects citizens with collection and route optimization.",
    "como.reportar": "Report",
    "como.reportarDesc":
      "Any resident reports the state of a container: full, damaged or overflowing, with a photo and exact location.",
    "como.recolectar": "Collect",
    "como.recolectarDesc":
      "Trucks receive routes adjusted to active incidents and the real state of each area.",
    "como.optimizar": "Optimize",
    "como.optimizarDesc":
      "The system analyzes accumulated data to improve frequencies, routes and container placement.",

    "serv.titulo": "Explore the platform",
    "serv.subtitulo":
      "Everything you need to follow the city's waste management.",
    "serv.mapaDesc": "Live location of containers, trucks and incidents.",
    "serv.estadisticasDesc":
      "Collection, incident and performance indicators by area.",
    "serv.documentacionDesc": "System guides, waste types and good practices.",

    "pie.tagline": "Integrated urban waste management, in real time.",
    "pie.plataforma": "Platform",
    "pie.cuenta": "Account",
    "pie.iniciar": "Log in",
    "pie.copy": "© 2026 Epsilon. All rights reserved.",

    "doc.titulo": "Documentation",
    "doc.subtitulo": "System manuals and information.",
    "doc.manual": "User Manual",
    "doc.guias": "Guides",
    "doc.faq": "Frequently Asked Questions",

    "pagina.login": "Login - Epsilon",
    "pagina.registro": "Sign up - Epsilon",
    "pagina.index": "Epsilon",

    "comun.cancelar": "Cancel",

    "login.mail": "Email",
    "login.contrasenia": "Password",
    "login.ingresar": "Log in",
    "login.olvido": "Forgot your password?",
    "login.crearCuenta": "Create Account",

    "registro.nombre": "First name",
    "registro.apellido": "Last name",
    "registro.mail": "Email",
    "registro.usuario": "Username",
    "registro.contrasenia": "Password",
    "registro.confirmar": "Confirm Password",
    "registro.registrarse": "Sign up",
    "registro.yaTengo": "I already have an account",

    "index.subtitulo": "Integrated Waste Collection and Management",
    "index.registrar": "Sign up",
    "index.iniciarSesion": "Log in",
    "index.notificaciones": "Notifications",
    "index.marcarLeidas": "Mark all as read",
    "index.sinNotificaciones": "You have no notifications.",
    "notificacion.incidencia_asignada":
      "Your incident #{id} was assigned to a crew.",
    "notificacion.incidencia_resuelta":
      "Your incident #{id} has been resolved.",
    "index.reportar": "Report incident",
    "index.crearIncidencia": "Create Incident",
    "index.tipo": "Type",
    "index.seleccioneTipo": "Select a type",
    "index.imagen": "Image",
    "index.contenedor": "Container:",
    "index.buscar": "Search by street, number or neighborhood",
    "index.direccionNueva": "Not on the list? Enter a new address",
    "index.volverLista": "Back to the container list",
    "index.calle": "Street",
    "index.numero": "Number",
    "index.barrio": "Neighborhood",
    "index.tipoContenedor": "Container type:",
    "index.cargandoContenedores": "Loading containers...",
    "index.sinContenedores": "There are no containers available.",
    "index.contenedoresNoEncontrados": "No containers found.",
    "index.errorContenedores": "Error loading containers.",
    "index.necesitaLogin": "You need to log in to report an incident.",
    "index.errorImagen": "Only JPG, JPEG or PNG images are allowed.",
    "index.errorRegistrar": "The incident could not be registered.",
    "index.overline": "Urban environmental management platform",
    "index.titulo":
      "Turning urban waste <span class='acento'>management</span> into something simpler and more sustainable",
    "index.descripcion":
      "Real-time monitoring, collection and route optimization for a cleaner, more efficient city.",
    "index.explorarMapa": "Explore Map",
    "index.datoContenedores": "Monitored containers",
    "index.datoResiduos": "Waste types classified",
    "index.datoSeguimiento": "Real-time tracking",
    "index.datoMin": "Min.",
    "index.datoRutas": "Routes optimized per incident",
    "index.comoFunciona": "How Epsilon works",
    "index.comoDesc":
      "A simple cycle that connects citizens with collection and route optimization.",
    "index.paso1": "Report",
    "index.paso1Desc":
      "Any resident reports the status of a container: full, damaged or overflowing, with a photo and exact location.",
    "index.paso2": "Collect",
    "index.paso2Desc":
      "Trucks receive routes adjusted to active incidents and the real condition of each area.",
    "index.paso3": "Optimize",
    "index.paso3Desc":
      "The system analyzes accumulated data to improve frequencies, routes and container locations.",
    "index.explora": "Explore the platform",
    "index.exploraDesc":
      "Everything you need to follow the city's waste management.",
    "index.servicioMapa": "Live location of containers, trucks and incidents.",
    "index.servicioEstadisticas":
      "Collection, incident and performance indicators by zone.",
    "index.servicioDocumentacion":
      "System guides, waste types and best practices.",

    "pie.descripcion": "Integrated urban waste management, in real time.",
    "pie.plataforma": "Platform",
    "pie.cuenta": "Account",
    "pie.registrarse": "Sign up",
    "pie.iniciar": "Log in",
    "pie.copy": "© 2026 Epsilon. All rights reserved.",
  },

  pt: {
    "pagina.estadisticas": "Estatísticas - Epsilon",
    "pagina.gestion": "Gestão - Epsilon",
    "pagina.documentacion": "Documentação - Epsilon",

    "menu.gestion": "Gestão",
    "menu.panelRutas": "Painel de Rotas",
    "menu.misIncidencias": "Minhas Incidências",
    "menu.panelOperario": "Painel do Operador",
    "menu.mapa": "Mapa",
    "menu.estadisticas": "Estatísticas",
    "menu.documentacion": "Documentação",

    "usuario.cerrarSesion": "Sair",
    "usuario.porDefecto": "Usuário",

    "comun.sinAsignar": "Não atribuído",
    "comun.conexion": "Erro de conexão.",

    "status.ok": "Operação realizada com sucesso.",
    "status.creado": "Criado com sucesso.",
    "status.datos_invalidos": "Dados inválidos. Revise os campos.",
    "status.error": "Ocorreu um erro. Tente novamente.",
    "status.no_encontrado": "O item solicitado não foi encontrado.",
    "status.no_autorizado": "Você precisa entrar na sua conta.",
    "status.no_permitido": "Ação não permitida.",
    "status.prohibido": "Você não tem permissão para realizar esta ação.",
    "status.no_disponible": "O recurso não está disponível.",
    "status.sin_camion": "A equipe não tem um caminhão atribuído.",
    "status.cuenta_pendiente": "Sua conta está pendente de aprovação.",

    "estado.Vacio": "Vazio",
    "estado.Media capacidad": "Meia capacidade",
    "estado.Lleno": "Cheio",
    "estado.Desbordado": "Transbordando",
    "estado.roto": "Quebrado",
    "estado.Disponible": "Disponível",
    "estado.En Servicio": "Em serviço",
    "estado.Mantenimiento": "Manutenção",
    "estado.Averiado": "Com defeito",
    "estado.Pendiente": "Pendente",
    "estado.Terminada": "Concluída",
    "estado.En Curso": "Em andamento",
    "estado.Finalizada": "Finalizada",
    "estado.Activo": "Ativo",
    "estado.Inactivo": "Inativo",
    "estado.Activa": "Ativa",
    "estado.Inactiva": "Inativa",

    "tipoIncidencia.rotura": "Contêiner danificado",
    "tipoIncidencia.lleno": "Contêiner cheio",
    "tipoIncidencia.desbordado": "Contêiner transbordando",
    "tipoIncidencia.incendiado": "Contêiner em chamas",

    "tipoContenedor.Naranja": "Laranja - Recicláveis",
    "tipoContenedor.Metalico": "Metálico - Resíduos mistos",
    "tipoContenedor.Plastico": "Plástico - Resíduos mistos",

    "rol.Vecino": "Morador",
    "rol.Recolector": "Coletor",
    "rol.Operario": "Operador",
    "rol.Administrador": "Administrador",

    "est.titulo": "Painel de Controle",
    "est.subtitulo": "Resumo geral do sistema.",
    "est.actualizado": "Atualizado:",
    "est.contenedores": "Contêineres totais",
    "est.incidencias": "Incidências pendentes",
    "est.centros": "Centros de coleta",
    "est.camiones": "Caminhões disponíveis",
    "est.rutas": "Rotas em andamento",
    "est.cuadrillas": "Equipes ativas",
    "est.eficiencia": "Eficiência",
    "est.eficienciaDesc":
      "Porcentagem de contêineres não saturados (vazios ou com meia capacidade).",
    "est.reporte": "Gerar relatório",
    "est.exportar": "Exportar dados",
    "est.informe": "Exportar histórico de incidências",
    "est.actualizar": "Atualizar métricas",
    "est.sinIncidencias": "Não há incidências para exportar.",
    "est.errorIncidencias":
      "Não foi possível obter o histórico de incidências.",

    "csv.metrica": "Métrica",
    "csv.valor": "Valor",
    "csv.contenedores": "Contêineres",

    "inc.id": "ID",
    "inc.fecha": "Data de criação",
    "inc.tipo": "Tipo",
    "inc.estado": "Estado",
    "inc.mail": "E-mail",
    "inc.calle": "Rua",
    "inc.numero": "Número",
    "inc.barrio": "Bairro",
    "inc.tipoContenedor": "Tipo de contêiner",
    "inc.operario": "Operador (ID)",
    "inc.cuadrilla": "Equipe",

    "gestion.eyebrow": "Administração",
    "gestion.titulo": "Gestão de Resíduos",
    "gestion.bienvenida":
      "Bem-vindo(a), {nombre}. Escolha um módulo para começar.",
    "gestion.modulos": "Módulos ativos",
    "gestion.monitoreo": "Monitoramento contínuo",
    "gestion.registro": "Registro",
    "gestion.registroDesc":
      "Cadastro geral de operações e movimentos do sistema.",
    "gestion.contenedores": "Contêineres",
    "gestion.contenedoresDesc":
      "Localização, tipo e estado de cada contêiner da cidade.",
    "gestion.camiones": "Caminhões",
    "gestion.camionesDesc":
      "Frota disponível e atribuição de caminhões coletores.",
    "gestion.usuarios": "Usuários",
    "gestion.usuariosDesc": "Contas, funções e permissões da equipe.",
    "gestion.centros": "Centros de Coleta",
    "gestion.centrosDesc":
      "Pontos de coleta, capacidade e estado de cada centro.",
    "gestion.rutas": "Rotas",
    "gestion.rutasDesc": "Traçado e ajuste das rotas de coleta.",
    "gestion.cuadrillas": "Equipes",
    "gestion.cuadrillasDesc": "Formação e gestão de equipes de coletores.",
    "gestion.incidencias": "Incidências",
    "gestion.incidenciasDesc": "Relatos dos cidadãos pendentes de resolução.",

    "pagina.login": "Entrar - Epsilon",
    "pagina.registro": "Cadastro - Epsilon",

    "comun.cancelar": "Cancelar",

    "auth.mail": "E-mail",
    "auth.contrasenia": "Senha",
    "auth.ingresar": "Entrar",
    "auth.olvidaste": "Esqueceu sua senha?",
    "auth.crearCuenta": "Criar conta",
    "auth.nombre": "Nome",
    "auth.apellido": "Sobrenome",
    "auth.correo": "E-mail",
    "auth.usuario": "Usuário",
    "auth.confirmar": "Confirmar senha",
    "auth.registrarse": "Cadastrar-se",
    "auth.yaTengoCuenta": "Já tenho uma conta",

    "index.registrar": "Cadastrar",
    "index.iniciarSesion": "Entrar",

    "notif.titulo": "Notificações",
    "notif.marcarLeidas": "Marcar todas como lidas",
    "notif.vacio": "Você não tem notificações.",

    "form.reportar": "Reportar incidência",
    "form.crearTitulo": "Criar Incidência",
    "form.tipo": "Tipo",
    "form.seleccioneTipo": "Selecione um tipo",
    "form.imagen": "Imagem",
    "form.contenedor": "Contêiner:",
    "form.buscar": "Buscar por rua, número ou bairro",
    "form.direccionNueva": "Não está na lista? Informar novo endereço",
    "form.volverLista": "Voltar à lista de contêineres",
    "form.calle": "Rua",
    "form.numero": "Número",
    "form.barrio": "Bairro",
    "form.tipoContenedor": "Tipo de contêiner:",
    "form.naranja": "Recicláveis",
    "form.cargando": "Carregando contêineres...",
    "form.sinContenedores": "Não há contêineres disponíveis.",
    "form.errorContenedores": "Erro ao carregar os contêineres.",
    "form.noEncontrados": "Nenhum contêiner encontrado.",
    "form.errorRegistrar": "Não foi possível registrar a incidência.",
    "form.soloImagenes": "Somente imagens JPG, JPEG ou PNG são permitidas.",
    "form.necesitasLogin": "Você precisa entrar para reportar uma incidência.",

    "hero.overline": "Plataforma de gestão ambiental urbana",
    "hero.titulo1": "Transformando a",
    "hero.titulo2": "gestão urbana",
    "hero.titulo3": "de resíduos em algo mais simples e sustentável",
    "hero.texto":
      "Monitoramento, coleta e otimização de rotas em tempo real, para uma cidade mais limpa e eficiente.",
    "hero.explorarMapa": "Explorar Mapa",

    "dato.contenedores": "+1.200",
    "dato.contenedoresDesc": "Contêineres monitorados",
    "dato.tiposDesc": "Tipos de resíduo classificados",
    "dato.seguimientoDesc": "Acompanhamento em tempo real",
    "dato.min": "Mín.",
    "dato.rutasDesc": "Rotas otimizadas por incidência",

    "como.titulo": "Como o Epsilon funciona",
    "como.subtitulo":
      "Um ciclo simples que conecta os cidadãos com a coleta e a otimização de rotas.",
    "como.reportar": "Reportar",
    "como.reportarDesc":
      "Qualquer morador informa o estado de um contêiner: cheio, danificado ou transbordando, com foto e localização exata.",
    "como.recolectar": "Coletar",
    "como.recolectarDesc":
      "Os caminhões recebem rotas ajustadas conforme as incidências ativas e o estado real de cada zona.",
    "como.optimizar": "Otimizar",
    "como.optimizarDesc":
      "O sistema analisa os dados acumulados para melhorar frequências, percursos e localização dos contêineres.",

    "serv.titulo": "Explore a plataforma",
    "serv.subtitulo":
      "Tudo o que você precisa para acompanhar a gestão de resíduos da cidade.",
    "serv.mapaDesc":
      "Localização ao vivo de contêineres, caminhões e incidências.",
    "serv.estadisticasDesc":
      "Indicadores de coleta, incidências e desempenho por zona.",
    "serv.documentacionDesc":
      "Guias do sistema, tipos de resíduo e boas práticas de uso.",

    "pie.tagline": "Gestão integral de resíduos urbanos, em tempo real.",
    "pie.plataforma": "Plataforma",
    "pie.cuenta": "Conta",
    "pie.iniciar": "Entrar",
    "pie.copy": "© 2026 Epsilon. Todos os direitos reservados.",

    "doc.titulo": "Documentação",
    "doc.subtitulo": "Manuais e informações do sistema.",
    "doc.manual": "Manual do Usuário",
    "doc.guias": "Guias",
    "doc.faq": "Perguntas Frequentes",

    "pagina.login": "Login - Epsilon",
    "pagina.registro": "Cadastro - Epsilon",
    "pagina.index": "Epsilon",

    "comun.cancelar": "Cancelar",

    "login.mail": "E-mail",
    "login.contrasenia": "Senha",
    "login.ingresar": "Entrar",
    "login.olvido": "Esqueceu sua senha?",
    "login.crearCuenta": "Criar Conta",

    "registro.nombre": "Nome",
    "registro.apellido": "Sobrenome",
    "registro.mail": "E-mail",
    "registro.usuario": "Usuário",
    "registro.contrasenia": "Senha",
    "registro.confirmar": "Confirmar Senha",
    "registro.registrarse": "Cadastrar-se",
    "registro.yaTengo": "Já tenho uma conta",

    "index.subtitulo": "Coleta e Gestão Integral de Resíduos",
    "index.registrar": "Cadastrar",
    "index.iniciarSesion": "Entrar",
    "index.notificaciones": "Notificações",
    "index.marcarLeidas": "Marcar todas como lidas",
    "index.sinNotificaciones": "Você não tem notificações.",
    "notificacion.incidencia_asignada":
      "Sua ocorrência #{id} foi atribuída a uma equipe.",
    "notificacion.incidencia_resuelta": "Sua ocorrência #{id} foi resolvida.",
    "index.reportar": "Reportar incidência",
    "index.crearIncidencia": "Criar Incidência",
    "index.tipo": "Tipo",
    "index.seleccioneTipo": "Selecione um tipo",
    "index.imagen": "Imagem",
    "index.contenedor": "Contêiner:",
    "index.buscar": "Buscar por rua, número ou bairro",
    "index.direccionNueva": "Não está na lista? Informar novo endereço",
    "index.volverLista": "Voltar para a lista de contêineres",
    "index.calle": "Rua",
    "index.numero": "Número",
    "index.barrio": "Bairro",
    "index.tipoContenedor": "Tipo de contêiner:",
    "index.cargandoContenedores": "Carregando contêineres...",
    "index.sinContenedores": "Não há contêineres disponíveis.",
    "index.contenedoresNoEncontrados": "Nenhum contêiner encontrado.",
    "index.errorContenedores": "Erro ao carregar os contêineres.",
    "index.necesitaLogin": "Você precisa entrar para reportar uma incidência.",
    "index.errorImagen":
      "Somente imagens nos formatos JPG, JPEG ou PNG são permitidas.",
    "index.errorRegistrar": "Não foi possível registrar a incidência.",
    "index.overline": "Plataforma de gestão ambiental urbana",
    "index.titulo":
      "Transformando a <span class='acento'>gestão urbana</span> de resíduos em algo mais simples e sustentável",
    "index.descripcion":
      "Monitoramento, coleta e otimização de rotas em tempo real, para uma cidade mais limpa e eficiente.",
    "index.explorarMapa": "Explorar Mapa",
    "index.datoContenedores": "Contêineres monitorados",
    "index.datoResiduos": "Tipos de resíduo classificados",
    "index.datoSeguimiento": "Acompanhamento em tempo real",
    "index.datoMin": "Mín.",
    "index.datoRutas": "Rotas otimizadas por incidência",
    "index.comoFunciona": "Como o Epsilon funciona",
    "index.comoDesc":
      "Um ciclo simples que conecta os cidadãos à coleta e à otimização de rotas.",
    "index.paso1": "Reportar",
    "index.paso1Desc":
      "Qualquer morador informa o estado de um contêiner: cheio, danificado ou transbordando, com foto e localização exata.",
    "index.paso2": "Coletar",
    "index.paso2Desc":
      "Os caminhões recebem rotas ajustadas conforme as incidências ativas e a situação real de cada zona.",
    "index.paso3": "Otimizar",
    "index.paso3Desc":
      "O sistema analisa os dados acumulados para melhorar frequências, percursos e localização dos contêineres.",
    "index.explora": "Explore a plataforma",
    "index.exploraDesc":
      "Tudo o que você precisa para acompanhar a gestão de resíduos da cidade.",
    "index.servicioMapa":
      "Localização ao vivo de contêineres, caminhões e incidências.",
    "index.servicioEstadisticas":
      "Indicadores de coleta, incidências e desempenho por zona.",
    "index.servicioDocumentacion":
      "Guias do sistema, tipos de resíduo e boas práticas de uso.",

    "pie.descripcion": "Gestão integral de resíduos urbanos, em tempo real.",
    "pie.plataforma": "Plataforma",
    "pie.cuenta": "Conta",
    "pie.registrarse": "Cadastrar-se",
    "pie.iniciar": "Entrar",
    "pie.copy": "© 2026 Epsilon. Todos os direitos reservados.",
  },
};

const LOCALES = { es: "es-UY", en: "en-US", pt: "pt-BR" };
const ZONA_HORARIA = "America/Montevideo";

let idioma = localStorage.getItem("idioma");
if (!TEXTOS[idioma]) {
  idioma = "es";
}

// ---------- Traducción ----------
function traducir(clave) {
  return TEXTOS[idioma][clave] || TEXTOS.es[clave] || clave;
}

function traducirValor(prefijo, valor) {
  return TEXTOS[idioma][`${prefijo}.${valor}`] || valor;
}

function mensajeStatus(resultado) {
  const status = resultado && resultado.status;
  return TEXTOS[idioma][`status.${status}`] || traducir("status.error");
}

// ---------- Fecha ----------
function formatearFechaHora(fecha) {
  return fecha.toLocaleString(LOCALES[idioma], { timeZone: ZONA_HORARIA });
}

function fechaUruguay() {
  return new Date().toLocaleDateString("sv-SE", { timeZone: ZONA_HORARIA });
}

// ---------- Aplicar idioma ----------
function aplicarIdioma() {
  document.documentElement.lang = idioma;

  document.querySelectorAll("[data-texto]").forEach((elemento) => {
    elemento.textContent = traducir(elemento.dataset.texto);
  });

  document.querySelectorAll("[data-html]").forEach((elemento) => {
    elemento.innerHTML = traducir(elemento.dataset.html);
  });

  document.querySelectorAll("[data-titulo]").forEach((elemento) => {
    elemento.title = traducir(elemento.dataset.titulo);
    elemento.setAttribute("aria-label", traducir(elemento.dataset.titulo));
  });

  document.querySelectorAll("[data-placeholder]").forEach((elemento) => {
    elemento.placeholder = traducir(elemento.dataset.placeholder);
  });

  document.querySelectorAll("[data-valor]").forEach((elemento) => {
    elemento.value = traducir(elemento.dataset.valor);
  });

  document.querySelectorAll("[data-titulo]").forEach((elemento) => {
    elemento.title = traducir(elemento.dataset.titulo);
    elemento.setAttribute("aria-label", traducir(elemento.dataset.titulo));
  });

  const selector = document.getElementById("selectorIdioma");
  if (selector) {
    selector.value = idioma;
  }
}

function cambiarIdioma(nuevoIdioma) {
  idioma = nuevoIdioma;
  localStorage.setItem("idioma", nuevoIdioma);
  aplicarIdioma();

  if (typeof alCambiarIdioma === "function") {
    alCambiarIdioma();
  }
}

// ---------- Selector ----------
function crearSelectorIdioma() {
  const selector = document.createElement("select");
  selector.id = "selectorIdioma";
  selector.className = "selector-idioma";
  selector.title = "Idioma / Language";
  selector.setAttribute("aria-label", "Idioma / Language");
  selector.innerHTML = `
    <option value="es">ES</option>
    <option value="en">EN</option>
    <option value="pt">PT</option>`;
  selector.addEventListener("change", () => cambiarIdioma(selector.value));

  const acciones = document.querySelector(".header-actions");
  if (acciones) {
    acciones.prepend(selector);
  } else {
    selector.classList.add("selector-idioma-fijo");
    document.body.appendChild(selector);
  }
}

document.addEventListener("DOMContentLoaded", () => {
  crearSelectorIdioma();
  aplicarIdioma();
});
