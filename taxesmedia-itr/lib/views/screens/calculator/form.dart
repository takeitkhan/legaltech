import 'package:flutter/material.dart';
import 'package:flutter_gen/gen_l10n/app_localizations.dart';
import 'package:itr/routes.dart';
import 'package:itr/views/screens/tax-info/income_sources.dart';
import 'package:itr/views/widgets/gradient_scaffold.dart';
import 'package:itr/views/widgets/transparent_app_bar.dart';

class CalculatorFormScreen extends StatelessWidget {
  const CalculatorFormScreen({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return GradientScaffold(
      appBar: TransparentAppBar(
        title: AppLocalizations.of(context)!.calculator,
      ),
      body: Padding(
        padding: const EdgeInsets.all(16.0),
        child: IncomeSourcesTab(
          onComplete: () => Navigator.pushNamed(context, Routes.result),
        ),
      ),
    );
  }
}
