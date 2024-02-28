import 'package:flutter/material.dart';
import 'package:flutter_gen/gen_l10n/app_localizations.dart';
import 'package:itr/views/widgets/gradient_scaffold.dart';
import 'package:itr/views/widgets/primary_button.dart';
import 'package:itr/views/widgets/transparent_app_bar.dart';

class ChatTab extends StatelessWidget {
  const ChatTab({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return GradientScaffold(
      appBar: TransparentAppBar(
        showDefaultLeading: false,
        title: AppLocalizations.of(context)!.chat,
      ),
      body: Padding(
        padding: const EdgeInsets.all(16.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.stretch,
          children: [
            Text(AppLocalizations.of(context)!.select_subject),
            const SizedBox(height: 10),
            DropdownButtonFormField<String>(
              value: 'expertAssistance',
              items: [
                DropdownMenuItem(
                  value: 'expertAssistance',
                  child: Text(AppLocalizations.of(context)!.expert_assistance),
                ),
              ],
              onChanged: (value) {},
            ),
            // const Spacer(),
            const SizedBox(height: 20),
            PrimaryButton(
              onTap: () {},
              text: AppLocalizations.of(context)!.submit_request,
            ),
          ],
        ),
      ),
    );
  }
}
