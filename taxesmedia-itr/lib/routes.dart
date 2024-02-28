import 'package:flutter/material.dart';
import 'package:itr/core/models/package.dart';
import 'package:itr/views/screens/account/account.dart';
import 'package:itr/views/screens/account/profile.dart';
import 'package:itr/views/screens/auth/send_otp.dart';
import 'package:itr/views/screens/auth/tin_nid.dart';
import 'package:itr/views/screens/auth/verify_otp.dart';
import 'package:itr/views/screens/auth/welcome.dart';
import 'package:itr/views/screens/calculator/form.dart';
import 'package:itr/views/screens/calculator/intro.dart';
import 'package:itr/views/screens/home/home.dart';
import 'package:itr/views/screens/package/details.dart';
import 'package:itr/views/screens/tax-info/add_bank_info.dart';
import 'package:itr/views/screens/tax-info/interests.dart';
import 'package:itr/views/screens/tax-info/interests_on_securities.dart';
import 'package:itr/views/screens/tax-info/rent_n_property.dart';
import 'package:itr/views/screens/tax-info/result.dart';
import 'package:itr/views/screens/tax-info/salary.dart';
import 'package:itr/views/screens/tax-info/tax_info.dart';
import 'package:itr/views/screens/upload/category.dart';
import 'package:itr/views/screens/upload/upload_documents.dart';

class Routes {
  static const welcome = 'welcome';
  static const sendOtp = 'sendOtp';
  static const verifyOtp = 'verifyOtp';
  static const tinNid = 'tinNid';
  static const home = 'home';
  static const taxInfo = 'taxInfo';
  static const addBankInfo = 'addBankInfo';
  static const salaryInfo = 'salaryInfo';
  static const interests = 'interests';
  static const interestsOnSecurities = 'interestsOnSecurities';
  static const rentNProperty = 'rentNProperty';
  static const result = 'result';
  static const packageDetails = 'packageDetails';
  static const account = 'account';
  static const profile = 'profile';
  static const category = 'category';
  static const uploadDocuments = 'uploadDocuments';
  static const calculatorIntro = 'calculatorIntro';
  static const calculatorForm = 'calculatorForm';

  static Route<dynamic>? onGenerateRoute(RouteSettings settings) {
    switch (settings.name) {
      case welcome:
        return MaterialPageRoute(builder: (context) => const WelcomeScreen());
      case sendOtp:
        return MaterialPageRoute(builder: (context) => const SendOTPScreen());
      case verifyOtp:
        return MaterialPageRoute(
          builder: (context) => VerfiyOTPScreen(
            number: settings.arguments as String,
          ),
        );
      case tinNid:
        return MaterialPageRoute(
          builder: (context) => TinNIDScreen(
            phoneNumber: settings.arguments as String,
          ),
        );
      case home:
        return MaterialPageRoute(builder: (context) => HomeScreen());
      case taxInfo:
        return MaterialPageRoute(builder: (context) => const TaxInfoScreen());
      case addBankInfo:
        return MaterialPageRoute(builder: (context) => const AddBankInfo());
      case salaryInfo:
        return MaterialPageRoute(
          builder: (context) => const SalaryInfoScreen(),
        );
      case interests:
        return MaterialPageRoute(builder: (context) => const InterestsScreen());
      case interestsOnSecurities:
        return MaterialPageRoute(
          builder: (context) => const InterestsOnSecuritiesScreen(),
        );
      case rentNProperty:
        return MaterialPageRoute(
          builder: (context) => const RentNPropertyTab(),
        );
      case result:
        return MaterialPageRoute(builder: (context) => const ResultScreen());
      case packageDetails:
        return MaterialPageRoute(
          builder: (context) => PackageDetailsScreen(
            package: settings.arguments as Package,
          ),
        );
      case account:
        return MaterialPageRoute(builder: (context) => const AccountScreen());
      case profile:
        return MaterialPageRoute(builder: (context) => const ProfileScreen());
      case category:
        return MaterialPageRoute(builder: (context) => const CategoryScreen());
      case uploadDocuments:
        return MaterialPageRoute(
          builder: (context) => UploadDocumentsScreen(
            category: (settings.arguments as Map)['category'],
            subCategory: (settings.arguments as Map)['subCategory'],
          ),
        );
      case calculatorIntro:
        return MaterialPageRoute(
          builder: (context) => const CalculatorIntroScreen(),
        );
      case calculatorForm:
        return MaterialPageRoute(
          builder: (context) => const CalculatorFormScreen(),
        );
    }
    return null;
  }
}
