import 'package:flutter/material.dart';
import 'package:flutter_gen/gen_l10n/app_localizations.dart';
import 'package:itr/routes.dart';
import 'package:itr/views/widgets/gradient_scaffold.dart';

class HomeTab extends StatelessWidget {
  const HomeTab({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return GradientScaffold(
      appBar: PreferredSize(
        preferredSize: const Size.fromHeight(80),
        child: SafeArea(
          child: Padding(
            padding: const EdgeInsets.all(16.0),
            child: Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: [
                Image.asset(
                  'assets/images/logo.png',
                  width: 200,
                ),
                GestureDetector(
                  onTap: () => Navigator.pushNamed(context, Routes.account),
                  child: Container(
                    padding: const EdgeInsets.all(8),
                    decoration: BoxDecoration(
                      border: Border.all(color: Colors.grey, width: 1.5),
                      borderRadius: BorderRadius.circular(12),
                    ),
                    child: Image.asset(
                      'assets/icons/person.png',
                      width: 20,
                      height: 20,
                      color: Theme.of(context).colorScheme.primary,
                    ),
                  ),
                ),
              ],
            ),
          ),
        ),
      ),
      body: Padding(
        padding: const EdgeInsets.symmetric(horizontal: 16),
        child: ListView(
          padding: const EdgeInsets.only(bottom: 16),
          children: [
            Text(
              AppLocalizations.of(context)!.hello_name('User'),
              style: Theme.of(context).textTheme.headline5,
            ),
            const SizedBox(height: 5),
            Text(
              AppLocalizations.of(context)!.hello_subtitle,
              style: Theme.of(context).textTheme.bodyMedium,
            ),
            const SizedBox(height: 20),
            GridView.count(
              shrinkWrap: true,
              crossAxisCount: 2,
              mainAxisSpacing: 16,
              crossAxisSpacing: 16,
              physics: const NeverScrollableScrollPhysics(),
              children: [
                GestureDetector(
                  onTap: () => Navigator.pushNamed(context, Routes.taxInfo),
                  child: Container(
                    decoration: BoxDecoration(
                      color: Theme.of(context).colorScheme.secondary,
                      border: Border.all(color: Colors.white),
                      borderRadius: BorderRadius.circular(40),
                    ),
                    padding: const EdgeInsets.all(8),
                    child: Column(
                      mainAxisAlignment: MainAxisAlignment.center,
                      children: [
                        Image.asset('assets/images/self-filing.png'),
                        Text(
                          AppLocalizations.of(context)!.file_your_taxes,
                          style: Theme.of(context).textTheme.headline6,
                          textAlign: TextAlign.center,
                        )
                      ],
                    ),
                  ),
                ),
                GestureDetector(
                  onTap: () => Navigator.pushNamed(context, Routes.category),
                  child: Container(
                    decoration: BoxDecoration(
                      color: Theme.of(context).colorScheme.secondary,
                      border: Border.all(color: Colors.white),
                      borderRadius: BorderRadius.circular(40),
                    ),
                    padding: const EdgeInsets.all(8),
                    child: Column(
                      mainAxisAlignment: MainAxisAlignment.center,
                      children: [
                        Image.asset('assets/images/we-file.png'),
                        Text(
                          AppLocalizations.of(context)!.we_file_taxes,
                          style: Theme.of(context).textTheme.headline6,
                          textAlign: TextAlign.center,
                        )
                      ],
                    ),
                  ),
                ),
              ],
            ),
            const SizedBox(height: 20),
            Text(
              AppLocalizations.of(context)!.calculator,
              style: Theme.of(context).textTheme.titleLarge,
            ),
            const SizedBox(height: 10),
            ListTile(
              onTap: () => Navigator.pushNamed(context, Routes.calculatorIntro),
              leading: Image.asset(
                'assets/icons/calculator.png',
                width: 24,
              ),
              title: Text(
                AppLocalizations.of(context)!.income_tax_calculator,
                style: Theme.of(context).textTheme.titleLarge,
              ),
              trailing: Container(
                padding: const EdgeInsets.all(3),
                decoration: const BoxDecoration(
                  color: Colors.white,
                  shape: BoxShape.circle,
                ),
                child: const Icon(Icons.arrow_forward),
              ),
              minLeadingWidth: 28,
              tileColor: const Color(0xFFFF7B1C).withOpacity(0.25),
              shape: RoundedRectangleBorder(
                borderRadius: BorderRadius.circular(20),
              ),
            ),
            const SizedBox(height: 20),
            Image.asset('assets/images/tax-tips.png'),
            const SizedBox(height: 16),
            Image.asset('assets/images/get-expert-guidance.png'),
          ],
        ),
      ),
    );
  }
}
