import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:get/get.dart';
import 'package:user/helper/get_di.dart' as di;
import 'package:user/view/screen/splash_screen.dart';

void main() async {
  WidgetsFlutterBinding.ensureInitialized();
  SystemChrome.setSystemUIOverlayStyle(
    const SystemUiOverlayStyle(
        statusBarColor: Colors.transparent,
        statusBarIconBrightness: Brightness.dark),
  );
  await di.init();
  runApp(const MyApp());
}

class MyApp extends StatefulWidget {
  const MyApp({Key? key}) : super(key: key);

  @override
  State<MyApp> createState() => _MyAppState();
}

class _MyAppState extends State<MyApp> {
  @override
  Widget build(BuildContext context) {
    return GetMaterialApp(
      theme: ThemeData(
        scaffoldBackgroundColor: const Color.fromARGB(255, 253, 253, 253),
        colorScheme: ColorScheme.fromSwatch().copyWith(
          primary: const Color(0xFF6148FA),
          secondary: const Color(0xFF6148FA),
        ),
        checkboxTheme: CheckboxThemeData(
          checkColor: MaterialStateProperty.all(const Color(0xFF6148FA)),
          fillColor: MaterialStateProperty.all(
            const Color.fromARGB(255, 230, 226, 226),
          ),
        ),
        fontFamily: 'Montserrat',
      ),
      debugShowCheckedModeBanner: false,
      home: const SplashScreen(),
    );
  }
}
