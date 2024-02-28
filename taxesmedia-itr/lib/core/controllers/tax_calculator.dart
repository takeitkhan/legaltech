import 'package:hooks_riverpod/hooks_riverpod.dart';

class TaxCalculator {
  // Salary
  double basicPay = 0;
  double dearness = 0;
  double conveyance = 0;
  double houseRent = 0;
  double medical = 0;
  double overtime = 0;
  double bonus = 0;
  bool transportFromEmployer = false;

  double calculateTax() {
    final taxableConveyance = conveyance > 30000 ? conveyance - 30000 : 0;
    double taxableHouseRent =
        houseRent - (basicPay / 2 < 300000 ? basicPay / 2 : 300000);
    taxableHouseRent = taxableHouseRent > 0 ? taxableHouseRent : 0;
    double taxableMedical =
        medical - (basicPay * 0.1 < 120000 ? basicPay * 0.1 : 120000);
    taxableMedical = taxableMedical > 0 ? taxableMedical : 0;
    double taxableTransport = 0;
    if (transportFromEmployer) {
      taxableTransport = basicPay * 0.05 > 60000 ? basicPay * 0.05 : 60000;
    }

    final taxableValue = basicPay +
        dearness +
        taxableConveyance +
        taxableHouseRent +
        taxableMedical +
        overtime +
        bonus +
        taxableTransport;

    double tax = 0; // initially 0 for first 3 lakhs
    double newAmount = taxableValue - 300000;

    if (newAmount > 0) {
      // 5% for next 10 lakhs
      if (newAmount <= 1000000) {
        tax += newAmount * 0.05;
      } else {
        tax += 1000000 * 0.05;
        newAmount -= 1000000;
        // 10% for next 30 lakhs
        if (newAmount <= 3000000) {
          tax += newAmount * 0.1;
        } else {
          tax += 3000000 * 0.1;
          newAmount -= 3000000;
          // 15% for next 40 lakhs
          if (newAmount <= 4000000) {
            tax += newAmount * 0.15;
          } else {
            tax += 4000000 * 0.15;
            newAmount -= 4000000;
            // 20% for next 50 lakhs
            if (newAmount <= 5000000) {
              tax += newAmount * 0.20;
            } else {
              tax += 5000000 * 0.20;
              newAmount -= 5000000;
              // 25% for the rest
              if (newAmount > 0) {
                tax += newAmount * 0.25;
              }
            }
          }
        }
      }
    }
    return tax > 0 && tax < 5000 ? 5000 : tax;
  }
}

final taxCalculatorProvider = Provider((ref) => TaxCalculator());
